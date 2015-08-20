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
use DateTime;

/**
 * Data class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Data {
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
    
    static public $block = [
        self::BLOCK_BHAVA,
        self::BLOCK_GRAHA,
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
    protected $DateTime = null;
    
    /**
     * Locality
     * 
     * @var Locality
     */
    protected $Locality = null;
    
    /**
     * Ganita object
     * 
     * @var Ganita
     */
    protected $Ganita = null;

    /**
     * Data array

     * @var array
     */
    protected $data = null;
    
    /**
     * List of blocks.
     * 
     * @param string $mode
     * @return array
     */
    static public function listBlock($mode = 'calc')
    {
        $blocks = array_flip(self::$block);
        
        switch ($mode){
            case 'all':
                $list = $blocks;
                break;
            case 'worising':
                unset($blocks['rising']);
                unset($blocks['user']);
                break;
            case 'main':
                return [self::BLOCK_GRAHA, self::BLOCK_BHAVA, self::BLOCK_LAGNA];
                break;
            case 'calc':
            default:
                unset($blocks['user']);
        }
        $blocks = array_flip($blocks);
        return $blocks;
    }
    
    /**
     * Constructor
     * 
     * @param DateTime $DateTime Date and time
     * @param Locality $Locality Locality
     * @param Ganita $Ganita Ganita method
     */
    public function __construct(DateTime $DateTime, Locality $Locality, Ganita $Ganita) {
        $this->setDateTime($DateTime);
        $this->setLocality($Locality);
        $this->setGanita($Ganita);
    }

    /**
     * Set date and time.
     * 
     * @param DateTime $DateTime Date
     * @return \Jyotish\Base\Data
     */
    public function setDateTime(DateTime $DateTime)
    {
        if(!is_null($this->DateTime)){
            if($DateTime->format('z') == $this->DateTime->format('z')){
                $this->clearData(self::listBlock('worising'));
            }else{
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
     * @return \Jyotish\Base\Data
     */
    public function setLocality(Locality $Locality)
    {
        if(!is_null($Locality)){
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
     * @return \Jyotish\Base\Data
     */
    public function setGanita(Ganita $Ganita)
    {
        $this->Ganita = $Ganita;
        
        return $this;
    }

    /**
     * Get DateTime object
     * 
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->DateTime;
    }
    
    /**
     * Get Locality object
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
     * @return array
     */
    public function getData(array $blocks = null)
    {
        if(is_null($blocks)){
            $result = $this->data;
        }else{
            foreach ($blocks as $block){
                $result[$block] = isset($this->data[$block]) ? $this->data[$block] : null;
            }
        }
        return $result;
    }

    /**
     * Calculation parameters of planets and houses.
     * 
     * @param null|array $params Array of blocks (optional)
     * @param null|array $options Options to set (optional)
     * @return \Jyotish\Base\Data
     */
    public function calcParams(array $params = null, array $options = null)
    {
        $dataParams = $this->Ganita->setData($this)->getParams($params, $options);
        $this->data = array_merge($this->data, $dataParams);
        
        return $this;
    }
    
    /**
     * Calculation of rising and setting.
     * 
     * @param string $graha Graha key (optional)
     * @param null|array $options Options to set (optional)
     * @return \Jyotish\Base\Data
     */
    public function calcRising($graha = Graha::KEY_SY, array $options = null)
    {
        $dataRising = $this->Ganita->setData($this)->getRising($graha, $options);
        $this->data[self::BLOCK_RISING] = $dataRising;
        
        return $this;
    }
    
    /**
     * Calculation of panchanga.
     * 
     * @param null|array $angas Array of angas (optional)
     * @param bool $withLimit Time limit (optional)
     * @return \Jyotish\Base\Data
     */
    public function calcPanchanga(array $angas = null, $withLimit = false)
    {
        $AngaDefiner = new AngaDefiner($this);
        $generateAnga = $AngaDefiner->generateAnga($angas, $withLimit);
        
        foreach ($generateAnga as $anga => $data){
            $this->data[self::BLOCK_PANCHANGA][$anga] = $data;
        }
        return $this;
    }

    /**
     * Calculation of extra lagnas.
     * 
     * @param null|array $lagnaKeys Array of lagna keys (optional)
     * @return \Jyotish\Base\Data
     */
    public function calcExtraLagna(array $lagnaKeys = null)
    {
        $Lagna = new Lagna($this);
        $generateLagna = $Lagna->generateLagna($lagnaKeys);
        
        foreach ($generateLagna as $key => $data){
            $this->data[self::BLOCK_LAGNA][$key] = $data;
        }
        return $this;
    }
    
    /**
     * Calculation of arudhas.
     * 
     * @param null|array $arudhaKeys Array of arudha keys (optional)
     * @param null|array $options Options to set (optional)
     * @return \Jyotish\Base\Data
     */
    public function calcBhavaArudha(array $arudhaKeys = null, array $options = null)
    {
        $Arudha = new Arudha($this, $options);
        $generateArudha = $Arudha->generateArudha($arudhaKeys);
        
        foreach ($generateArudha as $key => $data){
            $this->data[self::BLOCK_LAGNA][$key] = $data;
        }
        return $this;
    }
    
    /**
     * Calculation of upagrahas.
     * 
     * @param null|array $upagrahaKeys Array of upagraha keys (optional)
     * @return \Jyotish\Base\Data
     */
    public function calcUpagraha(array $upagrahaKeys = null)
    {
        $Upagraha = new Upagraha($this);
        $generateUpagraha = $Upagraha->generateUpagraha($upagrahaKeys);
        
        foreach ($generateUpagraha as $key => $data){
            $this->data[self::BLOCK_UPAGRAHA][$key] = $data;
        }
        return $this;
    }
    
    /**
     * Calculation of varga datas.
     * 
     * @param array $vargaKeys Varga keys
     * @return \Jyotish\Base\Data
     */
    public function calcVargaData(array $vargaKeys = [Varga::KEY_D9])
    {
        foreach ($vargaKeys as $vargaKey){
            $Varga = Varga::getInstance($vargaKey)->setData($this);
            $this->data[self::BLOCK_VARGA][$vargaKey] = $Varga->getVargaData();
        }
        return $this;
    }
    
    /**
     * Calculation of dasha.
     * 
     * @param string $type Dasha type (optional)
     * @param null|string $periodKey Key of period (optional)
     * @param null|array $options Options to set (optional)
     * @return \Jyotish\Base\Data
     */
    public function calcDasha($type = Dasha::TYPE_VIMSHOTTARI, $periodKey = 'now', array $options = null)
    {
        $Dasha = Dasha::getInstance($type, $options)->setData($this);
        $this->data[self::BLOCK_DASHA][$type] = $Dasha->getPeriods($periodKey);
        
        return $this;
    }

    /**
     * Calculation of yogas.
     * 
     * @param array $yogas
     * @return \Jyotish\Base\Data
     */
    public function calcYoga(array $yogas)
    {
        foreach ($yogas as $type){
            $Yoga = Yoga::getInstance($type)->setData($this);
            foreach ($Yoga->generateYoga() as $result){
                $this->data[self::BLOCK_YOGA][$type][] = $result;
            }
        }
        return $this;
    }

    /**
     * Clear data blocks.
     * 
     * @param null|array $blocks (optional)
     */
    public function clearData(array $blocks = null)
    {
        if(is_null($blocks)){
            $blocks = self::listBlock();
        }
        foreach ($blocks as $block){
            unset($this->data[$block]);
        }
    }
}