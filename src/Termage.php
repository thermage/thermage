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
use Termage\Elements\Heading;
use Termage\Elements\Anchor;
use Termage\Elements\Bold;
use Termage\Elements\Breakline;
use Termage\Elements\Chart;
use Termage\Elements\Div;
use Termage\Elements\Hr;
use Termage\Elements\Italic;
use Termage\Elements\Paragraph;
use Termage\Elements\Span;
use Termage\Elements\Strikethrough;
use Termage\Elements\Underline;
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
    private static ThemeInterface $theme;

    /**
     * The instance of Shortcodes class.
     */
    private static Shortcodes $shortcodes;

    /**
     * Get Shortcodes instance.
     *
     * @return Shortcodes Shortcodes instance.
     *
     * @access public
     */
    public static function getShortcodes(): Shortcodes
    {
        return self::$shortcodes ??= new Shortcodes(self::getTheme());
    }

    /**
     * Set a new instance of the shortcodes.
     *
     * @param Shortcodes $shortcodes Shortcodes instance.
     *
     * @access public
     */
    public static function setShortcodes(Shortcodes $shortcodes): void
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
    public static function bold(string $value = '', string $classes = ''): Bold
    {
        return new Bold(
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
    public static function anchor(string $value = '', string $classes = ''): Anchor
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
     * Create a new Heading element instance.
     *
     * @param string $value   Heading element value.
     * @param string $classes Heading element classes.
     *
     * @return Heading Returns Heading element instance.
     *
     * @access public
     */
    public static function heading(string $value = '', string $classes = ''): Heading
    {
        return new Heading(
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

    /**
     * Create a new Breakline element instance.
     *
     * @param string $value   Breakline element value.
     * @param string $classes Breakline element classes.
     *
     * @return Breakline Returns Breakline element instance.
     *
     * @access public
     */
    public static function breakline(string $value = '', string $classes = ''): Breakline
    {
        return new Breakline(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes
        );
    }

    /**
     * Create a new Strikethrough element instance.
     *
     * @param string $value   Strikethrough element value.
     * @param string $classes Strikethrough element classes.
     *
     * @return Strikethrough Returns Strikethrough element instance.
     *
     * @access public
     */
    public static function strikethrough(string $value = '', string $classes = ''): Strikethrough
    {
        return new Strikethrough(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes
        );
    }

    /**
     * Create a new Italic element instance.
     *
     * @param string $value   Italic element value.
     * @param string $classes Italic element classes.
     *
     * @return Italic Returns Italic element instance.
     *
     * @access public
     */
    public static function italic(string $value = '', string $classes = ''): Italic
    {
        return new Italic(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes
        );
    }

    /**
     * Create a new Underline element instance.
     *
     * @param string $value   Underline element value.
     * @param string $classes Underline element classes.
     *
     * @return Underline Returns Underline element instance.
     *
     * @access public
     */
    public static function underline(string $value = '', string $classes = ''): Underline
    {
        return new Underline(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes
        );
    }
}
