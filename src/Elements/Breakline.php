<?php

declare(strict_types=1);

/**
 * Thermage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/thermage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License.
 *
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 */

namespace Thermage\Elements;

use Thermage\Base\Element;

use const PHP_EOL;

final class Breakline extends Element
{
    /**
     * Render breakline element.
     *
     * @return string Returns rendered breakline element.
     *
     * @access public
     */
    public function render(): string
    {
        $this->value($this->getValue() . PHP_EOL);

        return $this->getValue();
    }
}
