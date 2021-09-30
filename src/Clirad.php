<?php

declare(strict_types=1);

namespace Clirad;

use Clirad\Components\Element;
use Symfony\Component\Console\Output\ConsoleOutput;

use function array_map;
use function is_array;

final class Clirad
{
    private static $renderer;

    public static function setRenderer($renderer = null): void
    {
        self::$renderer = $renderer;
    }

    public static function element(string $value = ''): Element
    {
        return new Element(
            self::$renderer ?? new ConsoleOutput(),
            $value
        );
    }
}
