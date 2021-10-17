<?php

declare(strict_types=1);

namespace Termage\Elements;

use Termage\Base\Element;

final class Div extends Element
{
    public function render(): string
    {
        return parent::render() . PHP_EOL;
    }
}