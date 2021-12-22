<?php

declare(strict_types=1);

/**
 * Thermage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/thermage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License.
 *
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 */

namespace Thermage\Parsers;

use Thermage\Base\Color;
use Thermage\Base\Styles;
use Thermage\Themes\Theme;
use Thermage\Themes\ThemeInterface;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Thunder\Shortcode\ShortcodeFacade;

use function str_replace;
use function strip_tags;
use function Thermage\getOsc;
use function Thermage\getCsi;
use function Thermage\getEsc;

class Shortcodes
{
    /**
     * Shortcodes facade.
     */
    private ShortcodeFacade $facade;

    /**
     * Theme class object.
     *
     * @access private
     */
    private static $theme;

    /**
     * Create a new Shortcodes instance.
     *
     * @access public
     */
    public function __construct($theme = null)
    {
        self::$theme  = $theme ??= new Theme();
        $this->facade = new ShortcodeFacade();
        $this->addDefaultShortcodes();
    }

    /**
     * Get instance of the theme that implements Themes interface.
     *
     * @return ThemeInterface Returns instance of the theme that implements Themes interface.
     *
     * @access public
     */
    public static function getTheme(): ThemeInterface
    {
        return self::$theme ??= new Theme();
    }

    /**
     * Set a new instance of the theme that implements Themes interface.
     *
     * @param ThemeInterface $theme Theme interface.
     *
     * @access public
     */
    public static function setTheme(ThemeInterface $theme): void
    {
        self::$theme = $theme;
    }

    /**
     * Get Shortcodes Facade.
     *
     * @return ShortcodeFacade Shortcodes instance.
     *
     * @access public
     */
    public function getFacade(): ShortcodeFacade
    {
        return $this->facade;
    }

    /**
     * Add shortcode handler.
     *
     * @param string   $name    Shortcode name.
     * @param callable $handler Shortcode handler.
     *
     * @access public
     */
    public function add(string $name, callable $handler): self
    {
        $this->facade->addHandler($name, $handler);

        return $this;
    }

    /**
     * Add event handler.
     *
     * @param string   $name    Shortcode event name.
     * @param callable $handler Shortcode handler name.
     *
     * @return self Returns instance of the Shortcodes class.
     *
     * @access public
     */
    public function addEvent(string $name, callable $handler): self
    {
        $this->facade->addEventHandler($name, $handler);

        return $this;
    }

    /**
     * Parses text into shortcodes.
     *
     * @param string $input A text containing Shortcodes
     *
     * @return array Returns array of parsed shortcodes.
     *
     * @access public
     */
    public function parseText(string $input): array
    {
        return $this->facade->parse($input);
    }

    /**
     * Parse and processes text to replaces shortcodes.
     *
     * @param string $input A text containing Shortcodes
     *
     * @return string Returns parses and processed text.
     *
     * @access public
     */
    public function parse(string $input): string
    {
        return $this->facade->process($input);
    }

    /**
     * Add default shortcode.
     *
     * @access protected
     */
    protected function addDefaultShortcodes(): void
    {
        // shortcode: [bold]Bold[/bold]
        $this->add('bold', fn (ShortcodeInterface $s) => $this->boldShortcode($s));

        // shortcode: [b]Bold[/b]
        $this->add('b', fn (ShortcodeInterface $s) => $this->boldShortcode($s));

        // shortcode: [italic]Italic[/italic]
        $this->add('italic', fn (ShortcodeInterface $s) => $this->italicShortcode($s));

        // shortcode: [i]Italic[/i]
        $this->add('i', fn (ShortcodeInterface $s) => $this->italicShortcode($s));

        // shortcode: [underline]Underline[/underline]
        $this->add('underline', fn (ShortcodeInterface $s) => $this->underlineShortcode($s));

        // shortcode: [u]Underline[/u]
        $this->add('u', fn (ShortcodeInterface $s) => $this->underlineShortcode($s));

        // shortcode: [strikethrough]Strikethrough[/strikethrough]
        $this->add('strikethrough', fn (ShortcodeInterface $s) => $this->strikethroughShortcode($s));

        // shortcode: [s]Strikethrough[/s]
        $this->add('s', fn (ShortcodeInterface $s) => $this->strikethroughShortcode($s));

        // shortcode: [dim]Dim[/dim]
        $this->add('dim', fn (ShortcodeInterface $s) => $this->dimShortcode($s));

        // shortcode: [d]Dim/d]
        $this->add('d', fn (ShortcodeInterface $s) => $this->dimShortcode($s));

        // shortcode: [blink]Blink[/blink]
        $this->add('blink', fn (ShortcodeInterface $s) => $this->blinkShortcode($s));

        // shortcode: [reverse]Reverse[/reverse]
        $this->add('reverse', fn (ShortcodeInterface $s) => $this->reverseShortcode($s));

        // shortcode: [invisible]Invisible[/invisible]
        $this->add('invisible', fn (ShortcodeInterface $s) => $this->invisibleShortcode($s));

        // shortcode: [anchor]Anchor[/anchor]
        $this->add('anchor', fn (ShortcodeInterface $s) => $this->anchorShortcode($s));

        // shortcode: [a href=]Anchor[/a]
        $this->add('a', fn (ShortcodeInterface $s) => $this->anchorShortcode($s));

        // shortcode: [color]Color[/color]
        $this->add('color', fn (ShortcodeInterface $s) => $this->colorShortcode($s));

        // shortcode: [bg]Background Color[/color]
        $this->add('bg', fn (ShortcodeInterface $s) => $this->bgShortcode($s));
    }

    /**
     * Strip shortcodes.
     *
     * @param string $value Value with shortcodes.
     *
     * @return string Value without shortcodes.
     *
     * @access public
     */
    public function stripShortcodes(string $value): string
    {
        return strip_tags(str_replace(['[', ']'], ['<', '>'], $value));
    }

    /**
     * Bold shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Bold shortcode.
     *
     * @access protected
     */
    protected function boldShortcode(ShortcodeInterface $s): string
    {
        return Styles::setBold() . $s->getContent() . Styles::resetBold();
    }

    /**
     * Italic shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Italic shortcode.
     *
     * @access protected
     */
    protected function italicShortcode(ShortcodeInterface $s): string
    {
        return Styles::setItalic() . $s->getContent() . Styles::resetItalic();
    }

    /**
     * Underline shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Underline shortcode.
     *
     * @access protected
     */
    protected function underlineShortcode(ShortcodeInterface $s): string
    {
        return Styles::setUnderline() . $s->getContent() . Styles::resetUnderline();
    }

    /**
     * Strikethrough shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Strikethrough shortcode.
     *
     * @access protected
     */
    protected function strikethroughShortcode(ShortcodeInterface $s): string
    {
        return Styles::setStrikethrough() . $s->getContent() . Styles::resetStrikethrough();
    }

    /**
     * Dim shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Dim shortcode.
     *
     * @access protected
     */
    protected function dimShortcode(ShortcodeInterface $s): string
    {
        return Styles::setDim() . $s->getContent() . Styles::resetDim();
    }

    /**
     * Blink shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Blink shortcode.
     *
     * @access protected
     */
    protected function blinkShortcode(ShortcodeInterface $s): string
    {
        return Styles::setBlink() . $s->getContent() . Styles::resetBlink();
    }

    /**
     * Reverse shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Reverse shortcode.
     *
     * @access protected
     */
    protected function reverseShortcode(ShortcodeInterface $s): string
    {
        return Styles::setReverse() . $s->getContent() . Styles::resetReverse();
    }

    /**
     * Invisible shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Invisible shortcode.
     *
     * @access protected
     */
    protected function invisibleShortcode(ShortcodeInterface $s): string
    {
        return Styles::setInvisible() . $s->getContent() . Styles::resetInvisible();
    }

    /**
     * Anchor shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Anchor shortcode.
     *
     * @access protected
     */
    protected function anchorShortcode(ShortcodeInterface $s): string
    {
        return getOsc() . "8;;" . $s->getParameter('href') . getEsc() . "\\" . $s->getContent() . getOsc() . "8;;" . getEsc() . "\\";
    }

    /**
     * Color shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Color shortcode.
     *
     * @access protected
     */
    protected function colorShortcode(ShortcodeInterface $s): string
    {
        if ($s->getBbCode()) {
            return Color::applyForegroundColor($s->getContent(), self::$theme->getVariables()->get('colors.' . $s->getBbCode(), $s->getBbCode()));
        }

        return $s->getContent();
    }

    /**
     * Background color shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Background color shortcode.
     *
     * @access protected
     */
    protected function bgShortcode(ShortcodeInterface $s): string
    {
        if ($s->getBbCode()) {
            return Color::applyBackgroundColor($s->getContent(), self::$theme->getVariables()->get('colors.' . $s->getBbCode(), $s->getBbCode()));
        }

        return $s->getContent();
    }
}
