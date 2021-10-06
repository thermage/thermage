<?php

declare(strict_types=1);

namespace Termage\Components;

use Termage\Base\Element;

final class Link extends Element
{
    /**
     * Set element href property.
     *
     * @return self Returns instance of the Link class.
     *
     * @access public
     */
    public function href(string $value): self
    {
        $this->getProperties()->set('href', $value);

        return $this;
    }
}
