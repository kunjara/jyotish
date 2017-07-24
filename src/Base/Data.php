<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base;

use Jyotish\Base\Locality;
use Jyotish\Graha\Graha;
use Jyotish\Graha\Lagna;
use Jyotish\Graha\Upagraha;
use Jyotish\Bhava\Arudha;
use Jyotish\Ganita\Time;
use Jyotish\Ganita\Method\AbstractGanita as Ganita;
use Jyotish\Panchanga\AngaDefiner;
use Jyotish\Varga\Varga;
use Jyotish\Dasha\Dasha;
use Jyotish\Yoga\Yoga;
use Jyotish\Muhurta\Hora;
use Jyotish\Base\Import\ImportInterface;
use DateTime;
use DateTimeZone;

/**
 * Data class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Data
{
    /**
     * Bhava block
     */
    const BLOCK_BHAVA = 'bhava';
    /**
     * Dasha block
     */
    const BLOCK_DASHA = 'dasha';
    /**
     * Graha block
     */
    const BLOCK_GRAHA = 'graha';
    /**
     * Kala block
     */
    const BLOCK_KALA = 'kala';
    /**
     * Extra block
     */
    const BLOCK_LAGNA = 'lagna';
    /**
     * Panchanga block
     */
    const BLOCK_PANCHANGA = 'panchanga';
    /**
     * Rising block
     */
    const BLOCK_RISING = 'rising';
    /**
     * Upagraha block
     */
    const BLOCK_UPAGRAHA = 'upagraha';
    /**
     * User block
     */
    const BLOCK_USER  = 'user';
    /**
     * Varga block
     */
    const BLOCK_VARGA = 'varga';
    /**
     * Yoga block
     */
    const BLOCK_YOGA = 'yoga';
    
    /**
     * All blocks.
     * 
     * @var array
     */
    public static $block = [
        self::BLOCK_BHAVA,
        self::BLOCK_DASHA,
        self::BLOCK_GRAHA,
        self::BLOCK_KALA,
        self::BLOCK_LAGNA,
        self::BLOCK_PANCHANGA,
        self::BLOCK_RISING,
        self::BLOCK_UPAGRAHA,
        self::BLOCK_USER,
        self::BLOCK_VARGA,
        self::BLOCK_YOGA,
    ];

    /**
     * DateTime
     * 
     * @var DateTime
     */
    private $DateTime = null;
    
    /**
     * Locality
     * 
     * @var Locality
     */
    private $Locality = null;
    
    /**
     * Ganita object
     * 
     * @var Ganita
     */
    private $Ganita = null;

    /**
     * Data array
     * 
     * @var array
     */
    private $data = null;
    
    /**
     * List of blocks.
     * 
     * @param string $mode
     * @return array
     */
    public static function listBlock($mode = 'calc')
    {
        $blocks = array_flip(self::$block);
        
        switch ($mode) {
            case 'all':
                return self::$block;
            case 'main':
                return [self::BLOCK_BHAVA, self::BLOCK_GRAHA, self::BLOCK_LAGNA];
            case 'worising':
                unset($blocks[self::BLOCK_RISING], $blocks[self::BLOCK_USER]);
                break;
            case 'calc':
            default:
                unset($blocks[self::BLOCK_USER]);
        }
        $list = array_flip($blocks);
        return $list;
    }
    
    /**
     * Returns new Data object from import data.
     * 
     * @param ImportInterface $Source
     * @return Data
     */
    public static function createFromImport(ImportInterface $Source)
    {
        $importData = $Source->getImportData();
        $Data = new Data();
        
        foreach ($importData as $block => $importElements) {
            $Data->setDataBlock($block, $importData[$block]);
            
            if ($block == self::BLOCK_USER) {
                if (isset($importData[$block]['datetime'])) {
                    $TimeZone = isset($importData[$block]['timezone']) ? new DateTimeZone($importData[$block]['timezone']) : null;
                    $DateTime = new DateTime($importData[$block]['datetime'], $TimeZone);
                    $Data->setDateTime($DateTime);
                }
                if (isset($importData[$block]['longitude']) && isset($importData[$block]['latitude'])) {
                    $Locality = new Locality([
                        'longitude' => $importData[$block]['longitude'],
                        'latitude' => $importData[$block]['latitude'],
                        'altitude' => isset($importData[$block]['altitude']) ? $importData[$block]['altitude'] : 0,
                    ]);
                    $Data->setLocality($Locality);
                }
            }
        }
        return $Data;
    }

    /**
     * Constructor
     * 
     * @param DateTime|null $DateTime Date and time
     * @param Locality|null $Locality Locality
     * @param Ganita|null $Ganita Ganita method
     */
    public function __construct(DateTime $DateTime = null, Locality $Locality = null, Ganita $Ganita = null)
    {
        if (!is_null($DateTime)) {
            $this->setDateTime($DateTime);
        }
        if (!is_null($Locality)) {
            $this->setLocality($Locality);
        }
        if (!is_null($Ganita)) {
            $this->setGanita($Ganita);
        }
    }
    
    /**
     * Clone data.
     */
    public function __clone()
    {
        $this->DateTime = clone $this->DateTime;
    }
    
    /**
     * Return a string representation of the data.
     * 
     * @return string
     */
    public function __toString() {
        return json_encode($this->data);
    }

    /**
     * Set date and time.
     * 
     * @param DateTime $DateTime Date
     * @return Data
     */
    public function setDateTime(DateTime $DateTime)
    {
        if (!is_null($this->DateTime)) {
            if ($DateTime->format('z') == $this->DateTime->format('z')) {
                $this->clearData(self::listBlock('worising'));
            } else {
                $this->clearData();
            }
        }
        $this->DateTime = $DateTime;
        
        $this->data[self::BLOCK_USER]['datetime'] = $this->DateTime->format(Time::FORMAT_DATETIME);
        $this->data[self::BLOCK_USER]['timezone'] = $this->DateTime->getTimezone()->getName();
         
        return $this;
    }
    
    /**
     * Set locality.
     * 
     * @param Locality $Locality Locality
     * @return Data
     */
    public function setLocality(Locality $Locality)
    {
        if (!is_null($this->Locality)) {
            $this->clearData();
        }
        $this->Locality = $Locality;
        
        $this->data[self::BLOCK_USER]['longitude'] = $this->Locality->getLongitude();
        $this->data[self::BLOCK_USER]['latitude'] = $this->Locality->getLatitude();
        $this->data[self::BLOCK_USER]['altitude'] = $this->Locality->getAltitude();
        
        return $this;
    }
    
    /**
     * Set ganita method.
     * 
     * @param Ganita $Ganita Ganita method
     * @return Data
     */
    public function setGanita(Ganita $Ganita)
    {
        $this->Ganita = $Ganita;
        
        return $this;
    }
    
    /**
     * Set data block.
     * 
     * @param string $blockName
     * @param array $blockData
     * @return Data
     */
    private function setDataBlock($blockName, array $blockData)
    {
        $this->data[$blockName] = $blockData;
        
        return $this;
    }

    /**
     * Get DateTime object.
     * 
     * @return DateTime
     */
    public function getDateTime()
    {
        return $this->DateTime;
    }
    
    /**
     * Get Locality object.
     * 
     * @return Locality
     */
    public function getLocality()
    {
        return $this->Locality;
    }
    
    /**
     * Get data array.
     * 
     * @param null|array $blocks Array of blocks (optional)
     * @param string $vargaKey Varga key (optional)
     * @return array Array block data
     * @throws Exception\InvalidArgumentException
     */
    public function getData(array $blocks = null, $vargaKey = Varga::KEY_D1)
    {
        $vargaKeyUcf = ucfirst($vargaKey);
        if (!array_key_exists($vargaKeyUcf, Varga::$varga)) {
            throw new Exception\InvalidArgumentException("Varga '$vargaKeyUcf' is not defined.");
        }
        
        if ($vargaKeyUcf == Varga::KEY_D1) {
            $dataVarga = $this->data;
        } else {
            $dataVarga = $this->data[self::BLOCK_VARGA][$vargaKeyUcf];
        }
        
        if (is_null($blocks)) {
            $result = $dataVarga;
        } else {
            $result = [];
            foreach ($blocks as $block) {
                if (!in_array($block, self::$block)) {
                    throw new Exception\InvalidArgumentException("Block '$block' is not defined.");
                }
                $result[$block] = isset($dataVarga[$block]) ? $dataVarga[$block] : null;
            }
        }
        
        return $result;
    }
    
    /**
     * Calculation parameters of planets and houses.
     * 
     * @param null|array $params Array of blocks (optional)
     * @param null|array $options Options to set (optional)
     * @return Data
     * @throws Exception\UnderflowException
     */
    public function calcParams(array $params = null, array $options = null)
    {
        if (is_null($this->Ganita)) {
            throw new Exception\UnderflowException("Ganita is not setted.");
        }
        $dataParams = $this->Ganita->setDataInstance($this)->getParams($params, $options);
        $this->data = array_merge($this->data, $dataParams);
        
        return $this;
    }
    
    /**
     * Calculation of rising and setting.
     * 
     * @param string $graha Graha key (optional)
     * @param null|array $options Options to set (optional)
     * @return Data
     * @throws Exception\UnderflowException
     */
    public function calcRising($graha = Graha::KEY_SY, array $options = null)
    {
        if (is_null($this->Ganita)) {
            throw new Exception\UnderflowException("Ganita is not setted.");
        }
        $dataRising = $this->Ganita->setDataInstance($this)->getRising($graha, $options);
        $this->data[self::BLOCK_RISING] = $dataRising;
        
        return $this;
    }
    
    /**
     * Calculation of panchanga.
     * 
     * @param null|array $angas Array of angas (optional)
     * @param bool $withLimit Time limit (optional)
     * @return Data
     */
    public function calcPanchanga(array $angas = null, $withLimit = false)
    {
        $AngaDefiner = new AngaDefiner($this);
        $generateAnga = $AngaDefiner->generateAnga($angas, $withLimit);
        
        foreach ($generateAnga as $anga => $data) {
            $this->data[self::BLOCK_PANCHANGA][$anga] = $data;
        }
        return $this;
    }

    /**
     * Calculation of extra lagnas.
     * 
     * @param null|array $lagnaKeys Array of lagna keys (optional)
     * @return Data
     */
    public function calcExtraLagna(array $lagnaKeys = null)
    {
        $Lagna = new Lagna($this);
        $generateLagna = $Lagna->generateLagna($lagnaKeys);
        
        foreach ($generateLagna as $key => $data) {
            $this->data[self::BLOCK_LAGNA][$key] = $data;
        }
        return $this;
    }
    
    /**
     * Calculation of arudhas.
     * 
     * @param null|array $arudhaKeys Array of arudha keys (optional)
     * @param null|array $options Options to set (optional)
     * @return Data
     */
    public function calcBhavaArudha(array $arudhaKeys = null, array $options = null)
    {
        $Arudha = new Arudha($this, $options);
        $generateArudha = $Arudha->generateArudha($arudhaKeys);
        
        foreach ($generateArudha as $key => $data) {
            $this->data[self::BLOCK_LAGNA][$key] = $data;
        }
        return $this;
    }
    
    /**
     * Calculation of upagrahas.
     * 
     * @param null|array $upagrahaKeys Array of upagraha keys (optional)
     * @return Data
     */
    public function calcUpagraha(array $upagrahaKeys = null)
    {
        $Upagraha = new Upagraha($this);
        $generateUpagraha = $Upagraha->generateUpagraha($upagrahaKeys);
        
        foreach ($generateUpagraha as $key => $data) {
            $this->data[self::BLOCK_UPAGRAHA][$key] = $data;
        }
        return $this;
    }
    
    /**
     * Calculation of varga datas.
     * 
     * @param array $vargaKeys Varga keys
     * @return Data
     */
    public function calcVargaData(array $vargaKeys)
    {
        foreach ($vargaKeys as $vargaKey) {
            if ($vargaKey == Varga::KEY_D1) {
                $this->calcParams();
            } else {
                $Varga = Varga::getInstance($vargaKey)->setDataInstance($this);
                $this->data[self::BLOCK_VARGA][$vargaKey] = $Varga->getVargaData();
            }
        }
        return $this;
    }
    
    /**
     * Calculation of dasha.
     * 
     * @param string $type Dasha type (optional)
     * @param null|string $periodKey Key of period (optional)
     * @param null|array $options Options to set (optional)
     * @return Data
     * @throws Exception\UnderflowException
     */
    public function calcDasha($type = Dasha::TYPE_VIMSHOTTARI, $periodKey = 'now', array $options = null)
    {
        if (is_null($this->DateTime)) {
            throw new Exception\UnderflowException("DateTime is not setted.");
        }
        $Dasha = Dasha::getInstance($type, $options)->setDataInstance($this);
        $this->data[self::BLOCK_DASHA][$type] = $Dasha->getPeriods($periodKey);
        
        return $this;
    }

    /**
     * Calculation of yogas.
     * 
     * @param array $yogas
     * @param null|array $options Options to set (optional)
     * @return Data
     */
    public function calcYoga(array $yogas, array $options = null)
    {
        foreach ($yogas as $type) {
            $Yoga = Yoga::getInstance($type, $options)->setDataInstance($this);
            foreach ($Yoga->generateYoga() as $result) {
                $this->data[self::BLOCK_YOGA][$type][] = $result;
            }
        }
        return $this;
    }
    
    /**
     * Calculation of hora.
     * 
     * @param type $type Hora type
     * @return Data
     * @throws Exception\UnderflowException
     */
    public function calcHora($type = Hora::TYPE_KALA)
    {
        if (is_null($this->DateTime)) {
            throw new Exception\UnderflowException("DateTime is not setted.");
        }
        $Hora = new Hora($this);
        $this->data[self::BLOCK_KALA]['hora'] = $Hora->getHora($type);
        
        return $this;
    }

    /**
     * Clear data blocks.
     * 
     * @param null|array $blocks (optional)
     */
    public function clearData(array $blocks = null)
    {
        if (is_null($blocks)) {
            $blocks = self::listBlock();
        }
        foreach ($blocks as $block) {
            unset($this->data[$block]);
        }
        return $this;
    }
}