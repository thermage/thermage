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

namespace Termage\Elements;

use Termage\Base\Element;

final class Span extends Element
{
    /**
     * Render Span element.
     *
     * @return string Returns rendered Span element.
     *
     * @access public
     */
    public function render(): string
    {
        $this->d($this->getStyles()->get('display') ?? 'inline');

        return parent::render();
    }
}
