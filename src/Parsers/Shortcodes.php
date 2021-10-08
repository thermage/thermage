<?php

declare(strict_types=1);

namespace Termage\Parsers;

use Thunder\Shortcode\ShortcodeFacade;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class Shortcodes
{
    /**
     * Create a new Shortcodes instance.
     *
     * @access public
     */
    public function __construct() {
        $this->shortcodes = new ShortcodeFacade();
        $this->addDefaultShortcodes();
    }

    /**
     * Shortcode facade.
     */
    public function facade(): ShortcodeFacade
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
        return $this->facade()->addHandler($name, $handler);
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
        return $this->facade()->addEventHandler($name, $handler);
    }

    /**
     * Parses text into shortcodes.
     *
     * @param string $input A text containing SHORTCODE
     *
     * @access public
     */
    public function parseText(string $input)
    {
        return $this->facade()->parse($input);
    }

    /**
     * Parse and processes text to replaces shortcodes.
     *
     * @param string $input A text containing SHORTCODE
     *
     * @access public
     */
    public function parse(string $input)
    {
        return $this->facade()->process($input);
    }

    /**
     * Add default shortcodes
     */
    private function addDefaultShortcodes(): void
    { 
        // shortcode: [bold]Bold text[/bold]
        $this->shortcodes->addHandler('bold', function($s) {
            return "\e[1m".$s->getContent()."\e[0m";
        });

        // shortcode: [dim]Italic text[/dim]
        $this->shortcodes->addHandler('dim', function($s) {
            return "\e[2m".$s->getContent()."\e[0m";
        });
        
        // shortcode: [italic]Italic text[/italic]
        $this->shortcodes->addHandler('italic', function($s) {
            return "\e[3m".$s->getContent()."\e[0m";
        });

        // shortcode: [underline]Underlne text[/underline]
        $this->shortcodes->addHandler('underline', function($s) {
            return "\e[4m".$s->getContent()."\e[0m";
        });

        // shortcode: [strikethrough]Underlne text[/strikethrough]
        $this->shortcodes->addHandler('strikethrough', function($s) {
            return "\e[9m".$s->getContent()."\e[0m";
        });
    }
}