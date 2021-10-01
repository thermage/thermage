<?php

declare(strict_types=1);

namespace Clirad;

use Clirad\Components\Element;
use Symfony\Component\Console\Output\ConsoleOutput as Renderer;
use Symfony\Component\Console\Output\OutputInterface as RendererInterface;

final class Clirad
{
    /**
     * Renderer.
     *
     * @access private
     */
    private static RendererInterface $renderer;

    /**
     * Set renderer.
     *
     * @param RendererInterface $renderer Renderer interface.
     *
     * @return void Void.
     *
     * @access public
     */
    public static function setRenderer(?RendererInterface $renderer = null): void
    {
        self::$renderer = $renderer;
    }

    /**
     * Get renderer.
     *
     * @return RendererInterface Renderer.
     *
     * @access public
     */
    public static function getRenderer(): RendererInterface
    {
        return self::$renderer;
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
            self::$renderer ?? new Renderer(),
            $value,
            $properties
        );
    }
}
