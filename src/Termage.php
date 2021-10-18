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
use Termage\Elements\Alert;
use Termage\Elements\Anchor;
use Termage\Elements\Blink;
use Termage\Elements\Bold;
use Termage\Elements\Chart;
use Termage\Elements\Div;
use Termage\Elements\Hr;
use Termage\Elements\Invisible;
use Termage\Elements\Paragraph;
use Termage\Elements\Span;
use Termage\Parsers\Shortcodes;
use Termage\Themes\Theme;
use Termage\Themes\ThemeInterface;

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
     * @return void
     *
     * @access public
     */
    public static function setShortcodes($shortcodes): void
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
     * @return void
     *
     * @access public
     */
    public static function setTheme(ThemeInterface $theme): void
    {
        self::$theme = $theme;
    }

    /**
     * Create a new Div element instance.
     *
     * @param string $value   Div element value.
     * @param string $classes Div element classes.
     *
     * @return Div Returns Div element instance.
     *
     * @access public
     */
    public static function div(string $value = '', string $classes = ''): Div
    {
        return new Div(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes
        );
    }

    /**
     * Create a new Span element instance.
     *
     * @param string $value   Span element value.
     * @param string $classes Span element classes.
     *
     * @return Span Returns Span element instance.
     *
     * @access public
     */
    public static function span(string $value = '', string $classes = ''): Span
    {
        return new Span(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes
        );
    }

    /**
     * Create a new Paragraph element instance.
     *
     * @param string $value   Paragraph element value.
     * @param string $classes Paragraph element classes.
     *
     * @return Paragraph Returns Paragraph element instance.
     *
     * @access public
     */
    public static function paragraph(string $value = '', string $classes = ''): Paragraph
    {
        return new Paragraph(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes
        );
    }

    /**
     * Create a new Hr element instance.
     *
     * @param string $value   Hr element value.
     * @param string $classes Hr element classes.
     *
     * @return Hr Returns Hr element instance.
     *
     * @access public
     */
    public static function hr(string $value = '', string $classes = ''): Hr
    {
        return new Hr(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes
        );
    }

    /**
     * Create a new Bold element instance.
     *
     * @param string $value   Bold element value.
     * @param string $classes Bold element classes.
     *
     * @return Bold Returns Bold element instance.
     *
     * @access public
     */
    public function bold(string $value = '', string $classes = ''): Bold
    {
        return new Bold(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes
        );
    }

    /**
     * Create a new Blink element instance.
     *
     * @param string $value   Blink element value.
     * @param string $classes Blink element classes.
     *
     * @return Blink Returns Blink element instance.
     *
     * @access public
     */
    public function blink(string $value = '', string $classes = ''): Blink
    {
        return new Blink(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes
        );
    }

    /**
     * Create a new Invisible element instance.
     *
     * @param string $value   Invisible element value.
     * @param string $classes Invisible element classes.
     *
     * @return Invisible Returns Invisible element instance.
     *
     * @access public
     */
    public function invisible(string $value = '', string $classes = ''): Invisible
    {
        return new Invisible(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes
        );
    }

    /**
     * Create a new Anchor element instance.
     *
     * @param string $value   Anchor element value.
     * @param string $classes Anchor element classes.
     *
     * @return Anchor Returns Anchor element instance.
     *
     * @access public
     */
    public function anchor(string $value = '', string $classes = ''): Anchor
    {
        return new Anchor(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes
        );
    }

    /**
     * Create a new Alert element instance.
     *
     * @param string $value   Alert element value.
     * @param string $classes Alert element classes.
     *
     * @return Alert Returns Alert element instance.
     *
     * @access public
     */
    public static function alert(string $value = '', string $classes = ''): Alert
    {
        return new Alert(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes
        );
    }

    /**
     * Create a new Chart element instance.
     *
     * @param string $value   Chart element value.
     * @param string $classes Chart element classes.
     *
     * @return Chart Returns Chart element instance.
     *
     * @access public
     */
    public static function chart(string $value = '', string $classes = ''): Chart
    {
        return new Chart(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes
        );
    }
}
