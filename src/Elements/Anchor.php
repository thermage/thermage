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

use function Thermage\getOsc;
use function Thermage\getEsc;

final class Anchor extends Element
{
    /**
     * Set anchor href.
     *
     * @param string $value Href value.
     *
     * @return self Returns instance of the Anchor class.
     *
     * @access public
     */
    public function href(string $value): self
    {
        $this->value(getOsc() . "8;;" . $value . getEsc() . "\\" . $this->getValue() . getOsc() . "8;;" . getEsc() . "\\");

        return $this;
    }

    /**
     * Render anchor element.
     *
     * @return string Returns rendered anchor element.
     *
     * @access public
     */
    public function render(): string
    {
        $this->d($this->getStyles()->get('display') ?? 'inline');

        return parent::render();
    }
}
