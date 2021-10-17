<?php

declare(strict_types=1);

namespace Termage\Elements;

use Termage\Base\Element;

final class Invisible extends Element
{
    public function render(): string
    {
        $this->invisible();

        return parent::render();
    }
}