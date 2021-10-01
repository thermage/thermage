<?php

declare(strict_types=1);

namespace Clirad;

use Clirad\Components\Element;
use Symfony\Component\Console\Output\ConsoleOutput as SymfonyRenderer;
use Symfony\Component\Console\Output\OutputInterface as SymfonyRendererInterface;

final class Clirad
{
    /**
     * Renderer.
     *
     * @access private
     */
    private static SymfonyRendererInterface $renderer;

    /**
     * Set renderer.
     *
     * @param SymfonyRendererInterface $renderer Renderer interface.
     *
     * @return void Void.
     *
     * @access public
     */
    public static function setRenderer(?SymfonyRendererInterface $renderer = null): void
    {
        self::$renderer = $renderer;
    }

    /**
     * Create element component.
     *
     * @param string $value      Element value.
     * @param array  $properties Element properties.
     *
     * @return Element Returns element component.
     *
     * @access public
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
