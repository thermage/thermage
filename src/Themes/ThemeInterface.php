<?php

declare(strict_types=1);

/**
 * Termage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/termage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      https://digital.flextype.org/termage/ Termage
 */

namespace Termage\Themes;

interface ThemeInterface
{
    /**
     * Get Theme variables.
     *
     * @return array Theme variables.
     *
     * @access public
     */
    public function getThemeVariables(): array;
}
