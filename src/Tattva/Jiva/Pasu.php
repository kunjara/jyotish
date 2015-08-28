<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Tattva\Jiva;

/**
 * Data class of chatushpada.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Pasu extends \Jyotish\Tattva\Jiva
{
    const ANIMAL_HORSE = 'horse';
    const ANIMAL_ELEPHANT = 'elephant';
    const ANIMAL_SHEEP = 'sheep';
    const ANIMAL_SERPENT = 'serpent';
    const ANIMAL_DOG = 'dog';
    const ANIMAL_CAT = 'cat';
    const ANIMAL_RAT = 'rat';
    const ANIMAL_COW = 'cow';
    const ANIMAL_BUFFALO = 'buffalo';
    const ANIMAL_TIGER = 'tiger';
    const ANIMAL_HARE = 'hare';
    const ANIMAL_MONKEY = 'monkey';
    const ANIMAL_LION = 'lion';
    const ANIMAL_MONGOOSE = 'mongoose';

    /**
     * Return a relation between animals.
     * 
     * @param string $animal1
     * @param string $animal2
     * @return string
     */
    public static function animalRelation($animal1, $animal2)
    {
        $hostile = [
            self::ANIMAL_COW => self::ANIMAL_TIGER,
            self::ANIMAL_ELEPHANT => self::ANIMAL_LION,
            self::ANIMAL_HORSE => self::ANIMAL_BUFFALO,
            self::ANIMAL_DOG => self::ANIMAL_HARE,
            self::ANIMAL_SERPENT => self::ANIMAL_MONGOOSE,
            self::ANIMAL_MONKEY => self::ANIMAL_SHEEP,
            self::ANIMAL_CAT => self::ANIMAL_RAT,
        ];

        if ($animal1 == $animal2) {
            return 'same';
        } elseif (
            (isset($hostile[$animal1]) && $hostile[$animal1] == $animal2) || 
            (isset($hostile[$animal2]) && $hostile[$animal2] == $animal1)
        ) {
            return 'hostile';
        } else {
            return 'friendly';
        }
    }
}
