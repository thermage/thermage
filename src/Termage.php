<?php

declare(strict_types=1);

/**
 * Termage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/termage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    Sergey Romanenko <sergey.romanenko@flextype.org>
 * @copyright Copyright (c) Sergey Romanenko (https://awilum.github.io)
 * @link      https://digital.flextype.org/termage/ Termage
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace Termage;

use Atomastic\Macroable\Macroable;
use Termage\Themes\ThemeInterface;
use Termage\Themes\Theme;
use Termage\Elements\Alert;
use Termage\Elements\Chart;
use Termage\Elements\Div;
use Termage\Elements\Paragraph;
use Termage\Elements\Bold;
use Termage\Elements\Italic;
use Termage\Elements\Underline;
use Termage\Elements\Dim;
use Termage\Elements\Invisible;
use Termage\Elements\Span;
use Termage\Elements\Strikethrough;
use Termage\Elements\Anchor;
use Termage\Elements\Reverse;
use Termage\Elements\Blink;
use Termage\Elements\Hr;
use Termage\Components\Emoji;
use Termage\Parsers\Shortcodes;

class Termage
{
    use Macroable;

    /**
     * The implementation of Theme interface.
     *
     * @access private
     */
    private static $theme = null;

    /**
     * The instance of Shortcodes class.
     */
    private static $shortcodes = null;

    /**
     * Get Shortcodes instance.
     *
     * @return Shortcodes Shortcodes instance.
     *
     * @access public
     */
    public static function getShortcodes(): Shortcodes
    {
        return self::$shortcodes ?? new Shortcodes(self::getTheme());
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
    public static function setShortcodes($shortcodes)
    {
        self::$shortcodes = $shortcodes;
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
        return self::$theme ?? new Theme();
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
    public static function setTheme(ThemeInterface $theme)
    {
        self::$theme = $theme;
    }

    /**
     * Create a new Div element instance.
     *
     * @param string $value Div value.
     * @param string $class Div classes.
     *
     * @return Div Returns Div element instance.
     *
     * @access public
     */
    public static function div(string $value = '', string $class = ''): Div
    {
        return new Div(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $class
        );
    }

    /**
     * Create a new Span element instance.
     *
     * @param string $value Span value.
     * @param string $class Span classes.
     *
     * @return Span Returns Span element instance.
     *
     * @access public
     */
    public static function span(string $value = '', string $class = ''): Span
    {
        return new Span(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $class
        );
    }

    /**
     * Create a new Paragraph element instance.
     *
     * @param string $value Paragraph value.
     * @param string $class Paragraph classes.
     *
     * @return Paragraph Returns Paragraph element instance.
     *
     * @access public
     */
    public static function paragraph(string $value = '', string $class = ''): Paragraph
    {
        return new Paragraph(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $class
        );
    }

    /**
     * Create a new Hr element instance.
     *
     * @param string $value Hr value.
     * @param string $class Hr classes.
     *
     * @return Hr Returns Hr element instance.
     *
     * @access public
     */
    public static function hr(string $value = '', string $class = ''): Hr
    {
        return new Hr(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $class
        );
    }

    /**
     * Create a new Bold element instance.
     *
     * @param string $value Bold value.
     * @param string $class Bold classes.
     *
     * @return Bold Returns Bold element instance.
     *
     * @access public
     */
    public function bold(string $value = '', string $class = ''): Bold
    {
        return new Bold(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $class
        );
    }

    /**
     * Create a new Blink element instance.
     *
     * @param string $value Blink value.
     * @param string $class Blink classes.
     *
     * @return Blink Returns Blink element instance.
     *
     * @access public
     */
    public function blink(string $value = '', string $class = ''): Blink
    {
        return new Blink(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $class
        );
    }

    /**
     * Create a new Invisible element instance.
     *
     * @param string $value Invisible value.
     * @param string $class Invisible classes.
     *
     * @return Invisible Returns Invisible element instance.
     *
     * @access public
     */
    public function invisible(string $value = '', string $class = ''): Invisible
    {
        return new Invisible(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $class
        );
    }

    /**
     * Create a new Anchor element instance.
     *
     * @param string $value Anchor value.
     * @param string $class Anchor classes.
     *
     * @return Anchor Returns Anchor element instance.
     *
     * @access public
     */
    public function anchor(string $value = '', string $class = ''): Anchor
    {
        return new Anchor(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $class
        );
    }

    /**
     * Create a new Alert element instance.
     *
     * @param string $value Alert value.
     * @param string $class Alert classes.
     *
     * @return Alert Returns Alert element instance.
     *
     * @access public
     */
    public static function alert(string $value = '', $class = ''): Alert
    {
        return new Alert(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $class
        );
    }

    /**
     * Create a new Chart element instance.
     *
     * @param string $value Chart value.
     * @param string $class Chart classes.
     *
     * @return Chart Returns Chart element instance.
     *
     * @access public
     */
    public static function chart(string $value = '', $class = ''): Chart
    {
        return new Chart(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $class
        );
    }
}
