<?php

declare(strict_types=1);

/**
 * Termage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/termage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License.
 *
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 */

namespace Termage\Base;

use function Termage\getCsi;

final class Screen
{
    /**
     * Clear saved lines sequence.
     * note: works only in xterm
     *
     * @return string Returns clear saved lines sequence.
     *
     * @access public
     */
    public static function clearSavedLines(): string
    {
        return getCsi() . '3J';
    }

    /**
     * Clear all sequence.
     *
     * @return string Returns clear saved lines sequence.
     *
     * @access public
     */
    public static function clearAll(): string
    {
        return getCsi() . '2J';
    }

    /**
     * Clear above sequence.
     *
     * @return string Returns clear saved lines sequence.
     *
     * @access public
     */
    public static function clearAbove(): string
    {
        return getCsi() . '1J';
    }

    /**
     * Clear below sequence.
     *
     * @return string Returns clear saved lines sequence.
     *
     * @access public
     */
    public static function clearBelow(): string
    {
        return getCsi() . '0J';
    }
}
