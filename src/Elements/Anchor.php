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

use function Thermage\terminal;

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
        $this->value(terminal()->getOsc() . "8;;" . $value . terminal()->getEsc() . "\\" . $this->getValue() . terminal()->getOsc() . "8;;" . terminal()->getEsc() . "\\");

        return $this;
    }

    /**
     * Render anchor element.
     *
     * @return string Returns rendered anchor element.
     *
     * @access public
     */
    public function renderToString(): string
    {
        $this->d($this->getStyles()->get('display') ?? 'inline');

        return parent::renderToString();
    }
}
