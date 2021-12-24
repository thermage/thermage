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

namespace Thermage;

use Glowy\Macroable\Macroable;
use Thermage\Elements\Alert;
use Thermage\Elements\Anchor;
use Thermage\Elements\Bold;
use Thermage\Elements\Breakline;
use Thermage\Elements\Chart;
use Thermage\Elements\Div;
use Thermage\Elements\Heading;
use Thermage\Elements\Hr;
use Thermage\Elements\Italic;
use Thermage\Elements\Paragraph;
use Thermage\Elements\Span;
use Thermage\Elements\Spinner;
use Thermage\Elements\Strikethrough;
use Thermage\Elements\Underline;
use Thermage\Elements\Canvas;
use Thermage\Parsers\Shortcodes;
use Thermage\Themes\Theme;
use Thermage\Themes\ThemeInterface;

class Thermage
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
     *
     * @access private
     */
    private static Shortcodes $shortcodes;

    /**
     * Control Sequence Escape.
     *
     * @access private
     */
    private static string $esc;

    /**
     * Control Sequence Introducer.
     *
     * @access private
     */
    private static string $csi;

    /**
     * Operating System Command.
     *
     * @access private
     */
    private static string $osc;

    /**
     * Get Control Sequence Introducer.
     *
     * @return string Control Sequence Introducer.
     *
     * @access public
     */
    public static function getCsi(): string
    {
        return self::$csi ??= self::getEsc() . '[';
    }

    /**
     * Set Control Sequence Introducer.
     *
     * @param string $value Control Sequence Introducer.
     *
     * @access public
     */
    public static function setCsi(string $value)
    {
        self::$csi = $value;
    }

    /**
     * Get Operating System Command.
     *
     * @return string Operating System Command.
     *
     * @access public
     */
    public static function getOsc(): string
    {
        return self::$osc ??= self::getEsc() . ']';
    }

    /**
     * Set Operating System Command.
     *
     * @param string $value Operating System Command.
     *
     * @access public
     */
    public static function setOsc(string $value)
    {
        self::$osc = $value;
    }

    /**
     * Get Control Sequence Escape.
     *
     * @return string Control Sequence Escape.
     *
     * @access public
     */
    public static function getEsc(): string
    {
        return self::$esc ??= "\033";
    }

    /**
     * Set Control Sequence Escape.
     *
     * @param string $value Control Sequence Escape.
     *
     * @access public
     */
    public static function setEsc(string $value)
    {
        self::$esc = $value;
    }

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
     * @param array  $styles  Div element styles.
     *
     * @return Div Returns Div element instance.
     *
     * @access public
     */
    public static function div(string $value = '', string $classes = '', array $styles = []): Div
    {
        return new Div(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes,
            $styles
        );
    }

    /**
     * Create a new Span element instance.
     *
     * @param string $value   Span element value.
     * @param string $classes Span element classes.
     * @param array  $styles  Span element styles.
     *
     * @return Span Returns Span element instance.
     *
     * @access public
     */
    public static function span(string $value = '', string $classes = '', array $styles = []): Span
    {
        return new Span(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes,
            $styles
        );
    }

    /**
     * Create a new Paragraph element instance.
     *
     * @param string $value   Paragraph element value.
     * @param string $classes Paragraph element classes.
     * @param array  $styles  Paragraph element styles.
     *
     * @return Paragraph Returns Paragraph element instance.
     *
     * @access public
     */
    public static function paragraph(string $value = '', string $classes = '', array $styles = []): Paragraph
    {
        return new Paragraph(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes,
            $styles
        );
    }

    /**
     * Create a new Hr element instance.
     *
     * @param string $value   Hr element value.
     * @param string $classes Hr element classes.
     * @param array  $styles  Hr element styles.
     *
     * @return Hr Returns Hr element instance.
     *
     * @access public
     */
    public static function hr(string $value = '', string $classes = '', array $styles = []): Hr
    {
        return new Hr(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes,
            $styles
        );
    }

    /**
     * Create a new Bold element instance.
     *
     * @param string $value   Bold element value.
     * @param string $classes Bold element classes.
     * @param array  $styles  Bold element styles.
     *
     * @return Bold Returns Bold element instance.
     *
     * @access public
     */
    public static function bold(string $value = '', string $classes = '', array $styles = []): Bold
    {
        return new Bold(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes,
            $styles
        );
    }

    /**
     * Create a new Anchor element instance.
     *
     * @param string $value   Anchor element value.
     * @param string $classes Anchor element classes.
     * @param array  $styles  Anchor element styles.
     *
     * @return Anchor Returns Anchor element instance.
     *
     * @access public
     */
    public static function anchor(string $value = '', string $classes = '', array $styles = []): Anchor
    {
        return new Anchor(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes,
            $styles
        );
    }

    /**
     * Create a new Alert element instance.
     *
     * @param string $value   Alert element value.
     * @param string $classes Alert element classes.
     * @param array  $styles  Alert element styles.
     *
     * @return Alert Returns Alert element instance.
     *
     * @access public
     */
    public static function alert(string $value = '', string $classes = '', array $styles = []): Alert
    {
        return new Alert(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes,
            $styles
        );
    }

    /**
     * Create a new Heading element instance.
     *
     * @param string $value   Heading element value.
     * @param string $classes Heading element classes.
     * @param array  $styles  Heading element styles.
     *
     * @return Heading Returns Heading element instance.
     *
     * @access public
     */
    public static function heading(string $value = '', string $classes = '', array $styles = []): Heading
    {
        return new Heading(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes,
            $styles
        );
    }

    /**
     * Create a new Chart element instance.
     *
     * @param string $value   Chart element value.
     * @param string $classes Chart element classes.
     * @param array  $styles  Chart element styles.
     * 
     * @return Chart Returns Chart element instance.
     *
     * @access public
     */
    public static function chart(string $value = '', string $classes = '', array $styles = []): Chart
    {
        return new Chart(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes,
            $styles
        );
    }

    /**
     * Create a new Breakline element instance.
     *
     * @param string $value   Breakline element value.
     * @param string $classes Breakline element classes.
     * @param array  $styles  Breakline element styles.
     *
     * @return Breakline Returns Breakline element instance.
     *
     * @access public
     */
    public static function breakline(string $value = '', string $classes = '', array $styles = []): Breakline
    {
        return new Breakline(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes,
            $styles
        );
    }

    /**
     * Create a new Strikethrough element instance.
     *
     * @param string $value   Strikethrough element value.
     * @param string $classes Strikethrough element classes.
     * @param array  $styles  Strikethrough element styles.
     *
     * @return Strikethrough Returns Strikethrough element instance.
     *
     * @access public
     */
    public static function strikethrough(string $value = '', string $classes = '', array $styles = []): Strikethrough
    {
        return new Strikethrough(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes,
            $styles
        );
    }

    /**
     * Create a new Italic element instance.
     *
     * @param string $value   Italic element value.
     * @param string $classes Italic element classes.
     * @param array  $styles  Italic element styles.
     *
     * @return Italic Returns Italic element instance.
     *
     * @access public
     */
    public static function italic(string $value = '', string $classes = '', array $styles = []): Italic
    {
        return new Italic(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes,
            $styles
        );
    }

    /**
     * Create a new Underline element instance.
     *
     * @param string $value   Underline element value.
     * @param string $classes Underline element classes.
     * @param array  $styles  Underline element styles.
     *
     * @return Underline Returns Underline element instance.
     *
     * @access public
     */
    public static function underline(string $value = '', string $classes = '', array $styles = []): Underline
    {
        return new Underline(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes,
            $styles
        );
    }

    /**
     * Create a new Canvas element instance.
     *
     * @param string $value   Canvas element value.
     * @param string $classes Canvas element classes.
     * @param array  $styles  Canvas element styles.
     *
     * @return Canvas Returns Canvas element instance.
     *
     * @access public
     */
    public static function canvas(string $value = '', string $classes = '', array $styles = []): Canvas
    {
        return new Canvas(
            self::getTheme(),
            self::getShortcodes(),
            $value,
            $classes,
            $styles
        );
    }
}
