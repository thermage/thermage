<?php

declare(strict_types=1);

namespace Termage;

use Atomastic\Macroable\Macroable;
use Termage\Utils\Terminal;
use Termage\Themes\ThemeInterface;
use Termage\Themes\Theme;
use Termage\Components\Alert;
use Termage\Components\Chart;
use Termage\Components\El;
use Termage\Components\Emoji;
use Termage\Components\Link;
use Termage\Components\Rule;
use Termage\Parsers\Shortcodes;

class Termage
{
    use Macroable;

    /**
     * Theme class object.
     *
     * @access private
     */
    private $theme;

    /**
     * The instance of Shortcodes clas.
     */
    private Shortcodes $shortcodes;

    /**
     * Create a new Termage instance.
     *
     * @param ThemeInterface $theme Theme interface.
     *
     * @access public
     */
    public function __construct(
        ?ThemeInterface $theme = null
    ) {
        $this->theme      = $theme ?? new Theme();
        $this->shortcodes = new Shortcodes($this->theme);
    }

    /**
     * Get Shortcodes instance.
     *
     * @return Shortcodes Shortcodes instance.
     *
     * @access public
     */
    public function getShortcodes(): Shortcodes
    {
        return $this->shortcodes;
    }

    /**
     * Get instance of the theme that implements Themes interface.
     *
     * @return ThemeInterface Returns instance of the theme that implements Themes interface.
     *
     * @access public
     */
    public function getTheme(): ThemeInterface
    {
        return $this->theme;
    }

    /**
     * Set a new instance of the theme that implements Themes interface.
     *
     * @param ThemeInterface $theme Theme interface.
     *
     * @return self Returns instance of the Termage class.
     *
     * @access public
     */
    public function theme(ThemeInterface $theme): self
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
     * @return El Returns El Component instance.
     *
     * @access public
     */
    public function el(string $value = '', array $properties = []): El
    {
        return new El(
            $this->theme,
            $this->shortcodes,
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
            $this->theme,
            $this->shortcodes,
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
            $this->theme,
            $this->shortcodes,
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
            $this->theme,
            $this->shortcodes,
            $value,
            $properties
        );
    }

    /**
     * Create a new Link Component instance.
     *
     * @param string $value      Link value.
     * @param array  $properties Link properties.
     *
     * @return Link Returns Link Component instance.
     *
     * @access public
     */
    public function link(string $value = '', array $properties = []): Link
    {
        return new Link(
            $this->theme,
            $this->shortcodes,
            $value,
            $properties
        );
    }

    /**
     * Create a new Chart Component instance.
     *
     * @param string $value      Chart value.
     * @param array  $properties Chart properties.
     *
     * @return Chart Returns Chart Component instance.
     *
     * @access public
     */
    public function chart(string $value = '', array $properties = []): Chart
    {
        return new Chart(
            $this->theme,
            $this->shortcodes,
            $value,
            $properties
        );
    }
}
