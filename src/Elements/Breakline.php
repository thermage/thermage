<?php

declare(strict_types=1);

namespace Termage\Elements;

use Termage\Base\Element;

final class Breakline extends Element
{
    public function render(): string
    {
        return $this->setContent($this->getContent() . PHP_EOL);
    }
}