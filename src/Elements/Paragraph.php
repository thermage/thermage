<?php

declare(strict_types=1);

namespace Termage\Elements;

use Termage\Base\Element;

final class Paragraph extends Element
{
    public function render(): string
    {
        return parent::render() . PHP_EOL;
    }
}