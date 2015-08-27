<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Calendar\Event;

/**
 * Appearance days of the Lord and His Incarnations.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class LordAppearance extends EventBase
{
    public static $eventsTitle = 'Appearance days of the Lord and His Incarnations';
    
    public static $eventsList = [
        [
            self::COL_NAME => 'Rama Navami',
            self::COL_MASA => 1,
            self::COL_TITHI => 9,
        ],
        [
            self::COL_NAME => 'Nrisimha Chaturdashi',
            self::COL_MASA => 2,
            self::COL_TITHI => 14,
        ],
        [
            self::COL_NAME => 'Balarama Purnima',
            self::COL_MASA => 5,
            self::COL_TITHI => 15,
        ],
        [
            self::COL_NAME => 'Shri Krishna Janmashtami',
            self::COL_MASA => 6,
            self::COL_TITHI => 23,
        ],
        [
            self::COL_NAME => 'Radhashtami',
            self::COL_MASA => 6,
            self::COL_TITHI > 8,
        ],
        [
            self::COL_NAME => 'Shri Vamana Dvadashi',
            self::COL_MASA => 6,
            self::COL_TITHI => 12,
        ],
        [
            self::COL_NAME => 'Shri Advaita Acharya',
            self::COL_MASA => 11,
            self::COL_TITHI => 7,
        ],
        [
            self::COL_NAME => 'Varaha Dvadashi',
            self::COL_MASA => 11,
            self::COL_TITHI => 12,
        ],
        [
            self::COL_NAME => 'Nityananda Trayodashi',
            self::COL_MASA => 11,
            self::COL_TITHI => 13
        ],
        [
            self::COL_NAME => 'Gaura Purnima',
            self::COL_MASA => 12,
            self::COL_TITHI => 15,
        ],
    ];
}
