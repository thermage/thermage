<?php

declare(strict_types=1);

namespace Termage;

use Termage\Components\Block;
use Termage\Components\Emoji;
use Atomastic\Macroable\Macroable;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class Termage
{
    use Macroable;
    
    /**
     * The implementation of the output.
     *
     * @access private
     */
    private OutputInterface $renderer;

    /**
     * Create a new Termage instance.
     *
     * @param OutputInterface $renderer Output interface.
     *
     * @access public
     */
    public function __construct (?OutputInterface $renderer = null)
    {
        $this->renderer = $renderer ??= new ConsoleOutput();
    }

    /**
     * Get renderer.
     *
     * @return OutputInterface Renderer.
     *
     * @access public
     */
    public function getRenderer(): OutputInterface
    {
        return $this->renderer;
    }

    /**
     * Create block component.
     *
     * @param string $value      Block value.
     * @param array  $properties Block properties.
     *
     * @return Block Returns block component.
     *
     * @access public
     */
    public function block(string $value = '', array $properties = []): Block
    {
        return new Block(
            $this->renderer,
            $value,
            $properties
        );
    }

    /**
     * Create emoji component.
     *
     * @param string $value      Emoji value.
     * @param array  $properties Emoji properties.
     *
     * @return Emoji Returns emoji component.
     *
     * @access public
     */
    public function emoji(string $value = '', array $properties = []): Emoji
    {
        return new Emoji(
            $this->renderer,
            $value,
            $properties
        );
    }
}
