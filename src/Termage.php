<?php

declare(strict_types=1);

namespace Termage;

use Atomastic\Macroable\Macroable;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Termage\Base\Theme;
use Termage\Components\Alert;
use Termage\Components\El;
use Termage\Components\Emoji;
use Termage\Components\Rule;
use Termage\Themes\DefaultTheme;

class Termage
{
    use Macroable;

    /**
     * The implementation of output renderer interface.
     *
     * @access private
     */
    private OutputInterface $renderer;

    /**
     * The instance of Theme class.
     *
     * @access private
     */
    private Theme $theme;

    /**
     * Create a new Termage instance.
     *
     * @param OutputInterface $renderer Output renderer interface.
     * @param Theme           $theme    Instance of the Theme class.
     *
     * @access public
     */
    public function __construct(?OutputInterface $renderer = null, ?Theme $theme = null)
    {
        $this->renderer = $renderer ??= new ConsoleOutput();
        $this->theme    = $theme ??= new DefaultTheme();
    }

    /**
     * Set output renderer interface.
     *
     * @param OutputInterface $renderer Output renderer interface.
     *
     * @return self Returns instance of the Termage class.
     *
     * @access public
     */
    public function renderer(OutputInterface $renderer): self
    {
        $this->renderer = $renderer;

        return $this;
    }

    /**
     * Get output renderer interface.
     *
     * @return OutputInterface Returns output renderer interface.
     *
     * @access public
     */
    public function getRenderer(): OutputInterface
    {
        return $this->renderer;
    }

    /**
     * Get instance of the Theme class.
     *
     * @return self Returns instance of the Theme class.
     *
     * @access public
     */
    public function getTheme(): Theme
    {
        return $this->theme;
    }

    /**
     * Set a new instance of the Theme class.
     *
     * @param Theme $theme Instance of the Theme class.
     *
     * @return self Returns instance of the Termage class.
     *
     * @access public
     */
    public function theme(Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Create a new El Component instance.
     *
     * @param string $value      Element value.
     * @param array  $properties Element properties.
     *
     * @return Block Returns El Component instance.
     *
     * @access public
     */
    public function el(string $value = '', array $properties = []): El
    {
        return new El(
            $this->renderer,
            $this->theme,
            $value,
            $properties
        );
    }

    /**
     * Create a new Emoji Component instance.
     *
     * @param string $value      Emoji value.
     * @param array  $properties Emoji properties.
     *
     * @return Emoji Returns Emoji Component instance.
     *
     * @access public
     */
    public function emoji(string $value = '', array $properties = []): Emoji
    {
        return new Emoji(
            $this->renderer,
            $this->theme,
            $value,
            $properties
        );
    }

    /**
     * Create a new Alert Component instance.
     *
     * @param string $value      Alert value.
     * @param array  $properties Alert properties.
     *
     * @return Alert Returns Alert Component instance.
     *
     * @access public
     */
    public function alert(string $value = '', array $properties = []): Alert
    {
        return new Alert(
            $this->renderer,
            $this->theme,
            $value,
            $properties
        );
    }

    /**
     * Create a new Rule Component instance.
     *
     * @param string $value      Rule value.
     * @param array  $properties Rule properties.
     *
     * @return Rule Returns Rule Component instance.
     *
     * @access public
     */
    public function rule(string $value = '', array $properties = []): Rule
    {
        return new Rule(
            $this->renderer,
            $this->theme,
            $value,
            $properties
        );
    }
}
