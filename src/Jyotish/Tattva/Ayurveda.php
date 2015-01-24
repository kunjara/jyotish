<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Tattva;

/**
 * Class of ayurveda data.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Ayurveda {
    /**
     * Energy that controls growth in the body. It supplies water to all body parts, 
     * moisturizes the skin, and maintains the immune system. 
     */
    const PRAKRITI_KAPHA = 'kapha';
    /**
     * Energy that controls the body's metabolic systems, including digestion, 
     * absorption, nutrition, and your body's temperature.
     */
    const PRAKRITI_PITTA = 'pitta';
    /**
     * Energy that controls bodily functions associated with motion, including 
     * blood circulation, breathing, blinking, and your heartbeat.
     */
    const PRAKRITI_VATA = 'vata';
    /**
     * Mixed energy.
     */
    const PRAKRITI_MISHRA = 'mishra';

    /**
     * Lymph
     */
    const DHATU_RASA = 'rasa';
    /**
     * Red part of the blood
     */
    const DHATU_RAKTA = 'rakta';
    /**
     * Muscle
     */
    const DHATU_MAMSA = 'mamsa';
    /**
     * Fatty tissue
     */
    const DHATU_MEDHA = 'medha';
    /**
     * Bone
     */
    const DHATU_ASTHI = 'asthi';
    /**
     * Bone marrow
     */
    const DHATU_MAJA = 'maja';
    /**
     * Reproductive tissue
     */
    const DHATU_SHUKRA = 'shukra';

    /**
     * Sweet
     */
    const RASA_MADHURA = 'madhura';
    /**
     * Salt
     */
    const RASA_LAVANA = 'lavana';
    /**
     * Sour
     */
    const RASA_AMLA = 'amla';
    /**
     * Astringent
     */
    const RASA_KASHAYA = 'kashaya';
    /**
     * Bitter
     */
    const RASA_TIKTA = 'tikta';
    /**
     * Spicy
     */
    const RASA_KATU = 'katu';
    /**
     * Mix
     */
    const RASA_MISHRA = 'mishra';
}
