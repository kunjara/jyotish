<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Calendar\Event;

/**
 * Appearance and disappearance days of recent acharyas.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class RecentAcharyas extends EventBase
{
    public static $eventsTitle = 'Appearance and disappearance days of recent acharyas';
    
    public static $eventsList = [
        [
            self::COL_NAME => 'Shrila Bhaktivinoda Thakura (Disappearance)',
            self::COL_MASA => 4,
            self::COL_TITHI => 30,
        ],
        [
            self::COL_NAME => 'Shri Vamshidasa Babaji (Disappearance)',
            self::COL_MASA => 5,
            self::COL_TITHI => 4,
        ],
        [
            self::COL_NAME => 'Shrila Prabhupada (Appearance)',
            self::COL_MASA => 6,
            self::COL_TITHI => 24,
        ],
        [
            self::COL_NAME => 'Shrila Bhaktivinoda (Appearance)',
            self::COL_MASA => 6,
            self::COL_TITHI => 13,
        ],
        [
            self::COL_NAME => 'Shri Madhvacharya (Appearance)',
            self::COL_MASA => 7,
            self::COL_TITHI => 10,
        ],
        [
            self::COL_NAME => 'Shrila Prabhupada (Disappearance)',
            self::COL_MASA => 8,
            self::COL_TITHI => 4,
        ],
        [
            self::COL_NAME => 'Shrila Gaura Kishora Dasa Babaji (Disappearance)',
            self::COL_MASA => 8,
            self::COL_TITHI => 11,
        ],
        [
            self::COL_NAME => 'Shrila Bhaktisiddhanta Sarasvati Thakura (Disappearance)',
            self::COL_MASA => 10,
            self::COL_TITHI => 19,
        ],
        [
            self::COL_NAME => 'Shrila Bhaktisiddhanta Sarasvati Thakura (Appearance)',
            self::COL_MASA => 12,
            self::COL_TITHI => 20,
        ],
        [
            self::COL_NAME => 'Shrila Jagannatha Dasa Babaji (Disappearance)',
            self::COL_MASA => 12,
            self::COL_TITHI => 1,
        ],
    ];
}