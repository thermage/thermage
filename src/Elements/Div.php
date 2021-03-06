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

final class Div extends Element
{
    /**
     * Render Div element.
     *
     * @return string Returns rendered Div element.
     *
     * @access public
     */
    public function renderToString(): string
    {
        $this->d($this->getStyles()->get('display') ?? 'block');

        return parent::renderToString();
    }
}
