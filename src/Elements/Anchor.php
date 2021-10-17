<?php

declare(strict_types=1);

namespace Termage\Elements;

use Termage\Base\Element;

final class Anchor extends Element
{
    /**
     * Set link href property.
     *
     * @param string $value Href value.
     *
     * @return self Returns instance of the Anchor class.
     *
     * @access public
     */
    public function href(string $value): self
    {
        $this->setValue("\e]8;;" . $value . "\e\\" . $this->getValue() . "\e]8;;\e\\");

        return $this;
    }
}