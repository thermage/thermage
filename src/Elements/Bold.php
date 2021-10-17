<?php

declare(strict_types=1);

namespace Termage\Elements;

use Termage\Base\Element;

final class Bold extends Element
{
    public function render(): string
    {
        $this->bold();

        return parent::render();
    }
}