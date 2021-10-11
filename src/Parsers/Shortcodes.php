<?php

declare(strict_types=1);

namespace Termage\Parsers;

use Termage\Base\Color;
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
    private $theme;

    /**
     * Create a new Shortcodes instance.
     *
     * @access public
     */
    public function __construct($theme)
    {
        $this->theme  = $theme;
        $this->facade = new ShortcodeFacade();
        $this->addDefaultShortcodes();
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
     * @param string   $name    Shortcode.
     * @param callable $handler Handler.
     *
     * @access public
     */
    public function addHandler(string $name, callable $handler)
    {
        return $this->facade->addHandler($name, $handler);
    }

    /**
     * Add event handler.
     *
     * @param string   $name    Event.
     * @param callable $handler Handler.
     *
     * @access public
     */
    public function addEventHandler(string $name, callable $handler)
    {
        return $this->facade->addEventHandler($name, $handler);
    }

    /**
     * Parses text into facade.
     *
     * @param string $input A text containing SHORTCODES
     *
     * @access public
     */
    public function parseText(string $input)
    {
        return $this->facade->parse($input);
    }

    /**
     * Parse and processes text to replaces facade.
     *
     * @param string $input A text containing SHORTCODES
     *
     * @access public
     */
    public function parse(string $input)
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
        $this->facade->addHandler('bold', fn (ShortcodeInterface $s) => $this->boldShortcode($s));

        // shortcode: [b]Bold[/b]
        $this->facade->addHandler('b', fn (ShortcodeInterface $s) => $this->boldShortcode($s));

        // shortcode: [italic]Italic[/italic]
        $this->facade->addHandler('italic', fn (ShortcodeInterface $s) => $this->italicShortcode($s));

        // shortcode:  [i]Italic[/i]
        $this->facade->addHandler('i', fn (ShortcodeInterface $s) => $this->italicShortcode($s));

        // shortcode: [underline]Underline[/underline]
        $this->facade->addHandler('underline', fn (ShortcodeInterface $s) => $this->underlineShortcode($s));

        // shortcode: [u]Underline[/u]
        $this->facade->addHandler('u', fn (ShortcodeInterface $s) => $this->underlineShortcode($s));

        // shortcode: [strikethrough]Strikethrough[/strikethrough]
        $this->facade->addHandler('strikethrough', fn (ShortcodeInterface $s) => $this->strikethroughShortcode($s));

        // shortcode: [s]Strikethrough[/s]
        $this->facade->addHandler('s', fn (ShortcodeInterface $s) => $this->strikethroughShortcode($s));

        // shortcode: [dim]Dim[/dim]
        $this->facade->addHandler('dim', fn (ShortcodeInterface $s) => $this->dimShortcode($s));

        // shortcode: [d]Dim/d]
        $this->facade->addHandler('d', fn (ShortcodeInterface $s) => $this->dimShortcode($s));

        // shortcode: [blink]Blink[/blink]
        $this->facade->addHandler('blink', fn (ShortcodeInterface $s) => $this->blinkShortcode($s));

        // shortcode: [reverse]Reverse[/reverse]
        $this->facade->addHandler('reverse', fn (ShortcodeInterface $s) => $this->reverseShortcode($s));

        // shortcode: [invisible]Invisible[/invisible]
        $this->facade->addHandler('invisible', fn (ShortcodeInterface $s) => $this->invisibleShortcode($s));

        // shortcode: [link href=]Link[/link]
        $this->facade->addHandler('link', fn (ShortcodeInterface $s) => $this->linkShortcode($s));

        // shortcode: [m l= r=]Margin left and right[/m]
        $this->facade->addHandler('m', fn (ShortcodeInterface $s) => $this->marginShortcode($s));

        // shortcode: [mx=]Margin left and right[/p]
        $this->facade->addHandler('mx', fn (ShortcodeInterface $s) => $this->marginBothShortcode($s));

        // shortcode: [ml=]Margin left[/p]
        $this->facade->addHandler('ml', fn (ShortcodeInterface $s) => $this->marginLeftShortcode($s));

        // shortcode: [mr=]Margin right[/p]
        $this->facade->addHandler('mr', fn (ShortcodeInterface $s) => $this->marginRightShortcode($s));

        // shortcode: [p l= r=]Padding left and right[/p]
        $this->facade->addHandler('p', fn (ShortcodeInterface $s) => $this->paddingShortcode($s));

        // shortcode: [px=]Padding left and right[/p]
        $this->facade->addHandler('px', fn (ShortcodeInterface $s) => $this->paddingBothShortcode($s));

        // shortcode: [pl=]Padding left[/p]
        $this->facade->addHandler('pl', fn (ShortcodeInterface $s) => $this->paddingLeftShortcode($s));

        // shortcode: [pr=]Padding right[/p]
        $this->facade->addHandler('pr', fn (ShortcodeInterface $s) => $this->paddingRightShortcode($s));

        // shortcode: [color=]Color[/color]
        $this->facade->addHandler('color', fn (ShortcodeInterface $s) => $this->colorShortcode($s));

        // shortcode: [bg=]Background Color[/color]
        $this->facade->addHandler('bg', fn (ShortcodeInterface $s) => $this->bgShortcode($s));
    }

    /**
     * Strip facade.
     *
     * @param string $value Value with facade.
     *
     * @return string Value without facade.
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
     * Link shortcode.
     *
     * @param ShortcodeInterface $s ShortcodeInterface
     *
     * @return string Link shortcode.
     *
     * @access protected
     */
    protected function linkShortcode(ShortcodeInterface $s): string
    {
        return "\e]8;;http://" . $s->getParameter('href') . "\e\\" . $s->getContent() . "\e]8;;\e\\";
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
            return (new Color($this->theme->variables()->get('colors.' . $s->getBbCode(), $s->getBbCode()), ''))->apply($s->getContent());
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
            return (new Color('', $this->theme->variables()->get('colors.' . $s->getBbCode(), $s->getBbCode())))->apply($s->getContent());
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

        if ($s->getParameter('l')) {
            $p['l'] = (string) strings(' ')->repeat((int) $s->getParameter('l'));
        }

        if ($s->getParameter('r')) {
            $p['r'] = (string) strings(' ')->repeat((int) $s->getParameter('r'));
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

        $themePaddingGlobal = $this->theme->variables()->get('padding.global', 1);
        $themePaddingLeft   = $this->theme->variables()->get('padding.left', 1);
        $themePaddingRight  = $this->theme->variables()->get('padding.right', 1);

        if ($s->getBbCode()) {
            $p['l'] = intval($s->getBbCode() / 2 * $themePaddingLeft * $themePaddingGlobal);
            $p['r'] = intval($s->getBbCode() / 2 * $themePaddingLeft * $themePaddingGlobal);
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

        $themePaddingGlobal = $this->theme->variables()->get('padding.global', 1);
        $themePaddingLeft   = $this->theme->variables()->get('padding.left', 1);

        if ($s->getBbCode()) {
            $p['l'] = intval($s->getBbCode() * $themePaddingLeft * $themePaddingGlobal);
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

        $themePaddingGlobal = $this->theme->variables()->get('padding.global', 1);
        $themePaddingRight  = $this->theme->variables()->get('padding.right', 1);

        if ($s->getBbCode()) {
            $p['r'] = intval($s->getBbCode() * $themePaddingRight * $themePaddingGlobal);
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

        if ($s->getParameter('l')) {
            $m['l'] = (string) strings(' ')->repeat((int) $s->getParameter('l'));
        }

        if ($s->getParameter('r')) {
            $m['r'] = (string) strings(' ')->repeat((int) $s->getParameter('r'));
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

        $themeMarginGlobal = $this->theme->variables()->get('margin.global', 1);
        $themeMarginLeft   = $this->theme->variables()->get('margin.left', 1);
        $themeMargingRight = $this->theme->variables()->get('margin.right', 1);

        if ($s->getBbCode()) {
            $m['l'] = intval($s->getBbCode() / 2 * $themeMarginLeft * $themeMarginGlobal);
            $m['r'] = intval($s->getBbCode() / 2 * $themeMarginLeft * $themeMarginGlobal);
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

        $themeMarginGlobal = $this->theme->variables()->get('margin.global', 1);
        $themeMarginLeft   = $this->theme->variables()->get('margin.left', 1);

        if ($s->getBbCode()) {
            $m['l'] = intval($s->getBbCode() * $themeMarginLeft * $themeMarginGlobal);
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

        $themeMarginGlobal = $this->theme->variables()->get('margin.global', 1);
        $themeMarginRight  = $this->theme->variables()->get('margin.right', 1);

        if ($s->getBbCode()) {
            $m['r'] = intval($s->getBbCode() * $themeMarginRight * $themeMarginGlobal);
        }

        return $s->getContent() . $m['r'];
    }
}
