<?php

declare(strict_types=1);

namespace Termage\Elements;

use Termage\Base\Element;

final class Strikethrough extends Element
{
    public function render(): string
    {
        $this->strikethrough();

        return parent::render();
    }
}