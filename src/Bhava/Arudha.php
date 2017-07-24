<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Bhava;

use Jyotish\Bhava\Bhava;
use Jyotish\Ganita\Math;

/**
 * Arudha class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Arudha
{
    use \Jyotish\Base\Traits\DataTrait;
    use \Jyotish\Base\Traits\OptionTrait;
    
    /**
     * Key of Arudha lagna
     */
    const KEY_AL = 'AL';
    /**
     * Key of 2 bhava pada
     */
    const KEY_A2 = 'A2';
    /**
     * Key of 3 bhava pada
     */
    const KEY_A3 = 'A3';
    /**
     * Key of 4 bhava pada
     */
    const KEY_A4 = 'A4';
    /**
     * Key of 5 bhava pada
     */
    const KEY_A5 = 'A5';
    /**
     * Key of 6 bhava pada
     */
    const KEY_A6 = 'A6';
    /**
     * Key of 7 bhava pada
     */
    const KEY_A7 = 'A7';
    /**
     * Key of 8 bhava pada
     */
    const KEY_A8 = 'A8';
    /**
     * Key of 9 bhava pada
     */
    const KEY_A9 = 'A9';
    /**
     * Key of 10 bhava pada
     */
    const KEY_A10 = 'A10';
    /**
     * Key of 11 bhava pada
     */
    const KEY_A11 = 'A11';
    /**
     * Key of Upapada lagna
     */
    const KEY_UL = 'UL';
    
    /**
     * List of arudhas (padas).
     * 
     * @var array
     */
    public static $arudha = [
        self::KEY_AL => 'Arudha Lagna',
        self::KEY_A2 => 'Dhanapada',
        self::KEY_A3 => 'Vikramapada',
        self::KEY_A4 => 'Matripada',
        self::KEY_A5 => 'Putrapada',
        self::KEY_A6 => 'Rogapada',
        self::KEY_A7 => 'Darapada',
        self::KEY_A8 => 'Mrityupada',
        self::KEY_A9 => 'Pitripada',
        self::KEY_A10 => 'Karmapada',
        self::KEY_A11 => 'Labhapada',
        self::KEY_UL => 'Upapada Lagna'
    ];
    
    /**
     * Use exceptions in bhava arudha padas.
     * 
     * @var bool
     */
    protected $optionUseException = true;
    /**
     * The deviation for exception in degrees.
     * 
     * @var float
     */
    protected $optionExceptionRang = 7.5;

    /**
     * Constructor
     * 
     * @param \Jyotish\Base\Data $Data
     * @param null|array $options Options to set
     */
    public function __construct(\Jyotish\Base\Data $Data, $options = null)
    {
        $this->setDataInstance($Data);
        $this->setOptions($options);
    }
    
    /**
     * Arudha calculation.
     * 
     * @param string $key Arudha key
     * @param null|array $options Options to set (optional)
     * @return array
     * @throws Exception\InvalidArgumentException
     */
    public function getArudha($key, array $options = null)
    {
        $this->checkData();
        
        if (!array_key_exists($key, self::$arudha)) {
            throw new Exception\InvalidArgumentException("Arudha with the key '$key' does not exist.");
        }

        if ($key == self::KEY_AL) {
            $bhavaKey = 1;
        } elseif ($key == self::KEY_UL) {
            $bhavaKey = 12;
        } else {
            $bhavaKey = substr($key, 1);
        }

        $Bhava = Bhava::getInstance($bhavaKey)->setEnvironment($this->Data);
        $bhavaRuler = $Bhava->getRuler();

        $lngRuler = $this->getData()['graha'][$bhavaRuler]['longitude'];
        $lngBhava = $this->getData()['bhava'][$bhavaKey]['longitude'];

        $lngDiff = $lngRuler - $lngBhava;
        $lngArudha = $lngRuler + $lngDiff;
        
        if ($lngArudha >= 360) {
            $lngArudha = $lngArudha - 360;
        } elseif ($lngArudha < 0) {
            $lngArudha = 360 + $lngArudha;
        }

        $unitArudha = Math::partsToUnits($lngArudha);
        $rashiArudha = $unitArudha['units'];
        
        if ($this->optionUseException) {
            if (
                Math::inRange($lngDiff, 0 - $this->optionExceptionRang, $this->optionExceptionRang) || 
                Math::inRange(abs($lngDiff), 90 - $this->optionExceptionRang, 90 + $this->optionExceptionRang)
            ) {
                $rashiArudha = Math::numberInCycle($unitArudha['units'], 10);
                $lngArudha = ($rashiArudha - 1) * 30 + $unitArudha['parts'];
            }
        }
        
        return [
            'longitude' => $lngArudha,
            'rashi' => $rashiArudha,
            'degree' => $unitArudha['parts'],
        ];
    }
    
    /**
     * Generation of arudhas.
     * 
     * @param null|array $arudhaKeys Array of arudha keys
     */
    public function generateArudha(array $arudhaKeys = null)
    {
        if (is_null($arudhaKeys)) {
            $arudhaKeys = array_keys(self::$arudha);
        }
        
        foreach ($arudhaKeys as $key) {
            yield $key => $this->getArudha($key);
        }
    }
}
