<?php

declare(strict_types=1);

namespace Termage;

use Atomastic\Macroable\Macroable;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Termage\Components\Block;
use Termage\Components\Emoji;

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
    public function __construct(?OutputInterface $renderer = null)
    {
        $this->renderer = $renderer ??= new ConsoleOutput();
    }

    /**
     * Set renderer.
     *
     * @param OutputInterface $renderer Base element renderer interface.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function renderer(OutputInterface $renderer): self
    {
        $this->renderer = $renderer;

        return $this;
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
