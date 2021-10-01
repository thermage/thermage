<?php

declare(strict_types=1);

namespace Clirad;

use Clirad\Components\Element;
use Symfony\Component\Console\Output\ConsoleOutput as SymfonyRenderer;
use Symfony\Component\Console\Output\OutputInterface as SymfonyRendererInterface;

use function array_map;
use function is_array;

final class Clirad
{
    /** 
     * Renderer.
     * 
     * @var SymfonyRendererInterface
     * 
     * @access private
     */
    private static SymfonyRendererInterface $renderer;

    /**
     * Set renderer.
     * 
     * @param SymfonyRendererInterface $renderer Renderer interface.
     * 
     * @access public 
     * 
     * @return void Void.
     */
    public static function setRenderer(SymfonyRendererInterface $renderer = null): void
    {
        self::$renderer = $renderer;
    }

    /**
     * Get Element Component.
     * 
     * @param string $value      Element value.
     * @param array  $properties Element properties.
     * 
     * @access public 
     * 
     * @return Element Element Component.
     */
    public static function element(string $value = '', array $properties = []): Element
    {
        return new Element(
            self::$renderer ?? new SymfonyRenderer(),
            $value,
            $properties
        );
    }
}
