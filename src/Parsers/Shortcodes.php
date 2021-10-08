<?php

declare(strict_types=1);

namespace Termage\Parsers;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Thunder\Shortcode\ShortcodeFacade;

class Shortcodes
{
    /**
     * Shortcodes facade.
     */
    private ShortcodeFacade $shortcodes;

    /**
     * Create a new Shortcodes instance.
     *
     * @access public
     */
    public function __construct()
    {
        $this->shortcodes = new ShortcodeFacade();
        $this->addDefaultShortcodes();
    }

    /**
     * Get Shortcodes instance.
     *
     * @return ShortcodeFacade Shortcodes instance.
     *
     * @access public
     */
    public function getShortcodes(): ShortcodeFacade
    {
        return $this->shortcodes;
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
        return $this->shortcodes->addHandler($name, $handler);
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
        return $this->shortcodes->addEventHandler($name, $handler);
    }

    /**
     * Parses text into shortcodes.
     *
     * @param string $input A text containing SHORTCODES
     *
     * @access public
     */
    public function parseText(string $input)
    {
        return $this->shortcodes->parse($input);
    }

    /**
     * Parse and processes text to replaces shortcodes.
     *
     * @param string $input A text containing SHORTCODES
     *
     * @access public
     */
    public function parse(string $input)
    {
        return $this->shortcodes->process($input);
    }

    /**
     * Add default shortcodes.
     *
     * @access protected
     */
    protected function addDefaultShortcodes(): void
    {
        // shortcode: [bold]Bold[/bold] [b]Bold[/b]
        $this->shortcodes->addHandler('bold', fn (ShortcodeInterface $s) => $this->boldShortcode($s));
        $this->shortcodes->addHandler('b', fn (ShortcodeInterface $s) => $this->boldShortcode($s));

        // shortcode: [italic]Italic[/italic] [i]Italic[/i]
        $this->shortcodes->addHandler('italic', fn (ShortcodeInterface $s) => $this->italicShortcode($s));
        $this->shortcodes->addHandler('i', fn (ShortcodeInterface $s) => $this->italicShortcode($s));

        // shortcode: [underline]Underline[/underline] [u]Underline[/u]
        $this->shortcodes->addHandler('underline', fn (ShortcodeInterface $s) => $this->underlineShortcode($s));
        $this->shortcodes->addHandler('u', fn (ShortcodeInterface $s) => $this->underlineShortcode($s));

        // shortcode: [strikethrough]Strikethrough[/strikethrough] [s]Strikethrough[/s]
        $this->shortcodes->addHandler('strikethrough', fn (ShortcodeInterface $s) => $this->strikethroughShortcode($s));
        $this->shortcodes->addHandler('s', fn (ShortcodeInterface $s) => $this->strikethroughShortcode($s));

        // shortcode: [dim]Dim[/dim] [d]Dim/d]
        $this->shortcodes->addHandler('dim', fn (ShortcodeInterface $s) => $this->dimShortcode($s));
        $this->shortcodes->addHandler('d', fn (ShortcodeInterface $s) => $this->dimShortcode($s));

        // shortcode: [blink]Blink[/blink]
        $this->shortcodes->addHandler('blink', fn (ShortcodeInterface $s) => $this->blinkShortcode($s));

        // shortcode: [reverse]Reverse[/reverse]
        $this->shortcodes->addHandler('reverse', fn (ShortcodeInterface $s) => $this->reverseShortcode($s));

        // shortcode: [invisible]Invisible[/invisible]
        $this->shortcodes->addHandler('invisible', fn (ShortcodeInterface $s) => $this->invisibleShortcode($s));

        // shortcode: [link href=]Termage[/link]
        $this->shortcodes->addHandler('link', fn (ShortcodeInterface $s) => $this->linkShortcode($s));
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
        return "\e[1m" . $s->getContent() . "\e[0m";
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
        return "\e[3m" . $s->getContent() . "\e[0m";
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
        return "\e[4m" . $s->getContent() . "\e[0m";
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
        return "\e[9m" . $s->getContent() . "\e[0m";
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
        return "\e[2m" . $s->getContent() . "\e[0m";
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
        return "\e[5m" . $s->getContent() . "\e[0m";
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
        return "\e[7m" . $s->getContent() . "\e[0m";
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
        return "\e[8m" . $s->getContent() . "\e[0m";
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
}
