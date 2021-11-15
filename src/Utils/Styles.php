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

namespace Termage\Utils;

use function Termage\getCsi;

final class Styles {

    /**
     * Reset all styles
     */
    public static function resetAll(): string
    {
        return getCsi() . "0m";
    }

    public static function setBold()
    {
        return getCsi() . "1m";
    }

    public static function resetBold()
    {
        return getCsi() . "22m";
    }
}