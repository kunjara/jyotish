<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Calendar\Event;

/**
 * ISKCON's historical events.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class IskconEvents extends EventBase
{
    public static $eventsTitle = 'ISKCON historical events';

    public static $eventsList = [
        [
            self::COL_NAME => 'Shri Jayananda Prabhu (Disappearance)',
            self::COL_MASA => 2,
            self::COL_TITHI => 13,
        ],
        [
            self::COL_NAME => 'The incorporation of ISKCON in New York',
            self::COL_MASA => 5,
            self::COL_TITHI => 24,
        ],
        [
            self::COL_NAME => 'Shrila Prabhupada departure for the USA',
            self::COL_MASA => 6,
            self::COL_TITHI => 16,
        ],
        [
            self::COL_NAME => 'Acceptance of sannyasa by Shrila Prabhupada',
            self::COL_MASA => 6,
            self::COL_TITHI => 15,
        ],
        [
            self::COL_NAME => 'Shrila Prabhupada arrival in the USA',
            self::COL_MASA => 7,
            self::COL_TITHI => 22,
        ],
    ];
}