<?php

declare(strict_types=1);

/**
 * Termage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/termage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License.
 *
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 */

namespace Termage\Parsers;

use Termage\Themes\Theme;
use Termage\Themes\ThemeInterface;
use Termage\Utils\Color;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Thunder\Shortcode\ShortcodeFacade;

use function intval;
use function str_replace;
use function strings;
use function strip_tags;

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

        // shortcode: [anchor href=]Anchor[/anchor]
        $this->add('anchor', fn (ShortcodeInterface $s) => $this->anchorShortcode($s));

        // shortcode: [a href=]Anchor[/a]
        $this->add('a', fn (ShortcodeInterface $s) => $this->anchorShortcode($s));

        // shortcode: [m l= r=]Margin left and right[/m]
        $this->add('m', fn (ShortcodeInterface $s) => $this->marginShortcode($s));

        // shortcode: [mx=]Margin left and right[/p]
        $this->add('mx', fn (ShortcodeInterface $s) => $this->marginBothShortcode($s));

        // shortcode: [ml=]Margin left[/p]
        $this->add('ml', fn (ShortcodeInterface $s) => $this->marginLeftShortcode($s));

        // shortcode: [mr=]Margin right[/p]
        $this->add('mr', fn (ShortcodeInterface $s) => $this->marginRightShortcode($s));

        // shortcode: [p l= r=]Padding left and right[/p]
        $this->add('p', fn (ShortcodeInterface $s) => $this->paddingShortcode($s));

        // shortcode: [px=]Padding left and right[/p]
        $this->add('px', fn (ShortcodeInterface $s) => $this->paddingBothShortcode($s));

        // shortcode: [pl=]Padding left[/p]
        $this->add('pl', fn (ShortcodeInterface $s) => $this->paddingLeftShortcode($s));

        // shortcode: [pr=]Padding right[/p]
        $this->add('pr', fn (ShortcodeInterface $s) => $this->paddingRightShortcode($s));

        // shortcode: [color=]Color[/color]
        $this->add('color', fn (ShortcodeInterface $s) => $this->colorShortcode($s));

        // shortcode: [bg=]Background Color[/color]
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
        return "\e[1m" . $s->getContent() . "\e[22m";
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
        return "\e[3m" . $s->getContent() . "\e[23m";
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
        return "\e[4m" . $s->getContent() . "\e[24m";
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
        return "\e[9m" . $s->getContent() . "\e[29m";
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
        return "\e[2m" . $s->getContent() . "\e[22m";
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
        return "\e[5m" . $s->getContent() . "\e[25m";
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
        return "\e[7m" . $s->getContent() . "\e[27m";
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
        return "\e[8m" . $s->getContent() . "\e[28m";
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
        return "\e]8;;" . $s->getParameter('href') . "\e\\" . $s->getContent() . "\e]8;;\e\\";
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
            return (new Color())->textColor(self::$theme->getVariables()->get('colors.' . $s->getBbCode(), $s->getBbCode()))->apply($s->getContent());
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
            return (new Color())->bgColor(self::$theme->getVariables()->get('colors.' . $s->getBbCode(), $s->getBbCode()))->apply($s->getContent());
        }

        return $s->getContent();
    }

    /**
     * Padding shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Padding shortcode result.
     *
     * @access protected
     */
    protected function paddingShortcode(ShortcodeInterface $s): string
    {
        $p = ['l' => '', 'r' => ''];

        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        if ($s->getParameter('l')) {
            $p['l'] = (string) strings(' ')->repeat(intval($s->getParameter('l') * $themeSpacer));
        }

        if ($s->getParameter('r')) {
            $p['r'] = (string) strings(' ')->repeat(intval($s->getParameter('r') * $themeSpacer));
        }

        return $p['l'] . $s->getContent() . $p['r'];
    }

    /**
     * Padding both shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Padding both shortcode result.
     *
     * @access protected
     */
    protected function paddingBothShortcode(ShortcodeInterface $s): string
    {
        $p = ['l' => '', 'r' => ''];

        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $pl = intval($s->getBbCode() * $themeSpacer);
        $pr = intval($s->getBbCode() * $themeSpacer);

        if ($s->getBbCode()) {
            $p['l'] = (string) strings(' ')->repeat($pl);
            $p['r'] = (string) strings(' ')->repeat($pr);
        }

        return $p['l'] . $s->getContent() . $p['r'];
    }

    /**
     * Padding left shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Padding left shortcode result.
     *
     * @access protected
     */
    protected function paddingLeftShortcode(ShortcodeInterface $s): string
    {
        $p = ['l' => ''];

        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $pl = intval($s->getBbCode() * $themeSpacer);

        if ($s->getBbCode()) {
            $p['l'] = (string) strings(' ')->repeat($pl);
        }

        return $p['l'] . $s->getContent();
    }

    /**
     * Padding right shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Padding right shortcode result.
     *
     * @access protected
     */
    protected function paddingRightShortcode(ShortcodeInterface $s): string
    {
        $p = ['r' => ''];

        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $pr = intval($s->getBbCode() * $themeSpacer);

        if ($s->getBbCode()) {
            $p['r'] = (string) strings(' ')->repeat($pr);
        }

        return $s->getContent() . $p['r'];
    }

    /**
     * Margin shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Margin shortcode result.
     *
     * @access protected
     */
    protected function marginShortcode(ShortcodeInterface $s): string
    {
        $m = ['l' => '', 'r' => ''];

        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        if ($s->getParameter('l')) {
            $m['l'] = (string) strings(' ')->repeat(intval($s->getParameter('l') * $themeSpacer));
        }

        if ($s->getParameter('r')) {
            $m['r'] = (string) strings(' ')->repeat(intval($s->getParameter('r') * $themeSpacer));
        }

        return $m['l'] . $s->getContent() . $m['r'];
    }

    /**
     * Margin both shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Margin both shortcode result.
     *
     * @access protected
     */
    protected function marginBothShortcode(ShortcodeInterface $s): string
    {
        $m = ['l' => '', 'r' => ''];

        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $ml = intval($s->getBbCode() * $themeSpacer);
        $mr = intval($s->getBbCode() * $themeSpacer);

        if ($s->getBbCode()) {
            $m['l'] = (string) strings(' ')->repeat($ml);
            $m['r'] = (string) strings(' ')->repeat($mr);
        }

        return $m['l'] . $s->getContent() . $m['r'];
    }

    /**
     * Margin left shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Margin left shortcode result.
     *
     * @access protected
     */
    protected function marginLeftShortcode(ShortcodeInterface $s): string
    {
        $m = ['l' => ''];

        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $ml = intval($s->getBbCode() * $themeSpacer);

        if ($s->getBbCode()) {
            $m['l'] = (string) strings(' ')->repeat($ml);
        }

        return $m['l'] . $s->getContent();
    }

    /**
     * Margin right shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Margin right shortcode result.
     *
     * @access protected
     */
    protected function marginRightShortcode(ShortcodeInterface $s): string
    {
        $m = ['r' => ''];

        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $mr = intval($s->getBbCode() * $themeSpacer);

        if ($s->getBbCode()) {
            $m['r'] = (string) strings(' ')->repeat($mr);
        }

        return $s->getContent() . $m['r'];
    }
}
