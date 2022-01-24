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
use Thermage\Parsers\Shortcodes;
use Thermage\Base\Element;
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
     * Render elements to the output/string.
     *
     * @param string|Element $elements Elements.
     * 
     * @access public
     */
    public static function render($elements, ?callable $callback = null, $output = true)
    {
        if ($elements instanceof Element) {
            $elements = $elements->renderToString();
        }

        $elements = Element::replaceSystemChars($elements);

        if ($output) {
            echo ($callback === null) ? $elements : call_user_func($callback, $elements);
        } else {
            return ($callback === null) ? $elements : call_user_func($callback, $elements);
        }
    }

    /**
     * Render elements to the string.
     *
     * @param string|Element $elements Elements.
     * 
     * @access public
     */
    public static function renderToString($elements, ?callable $callback = null): string
    {
        if ($elements instanceof Element) {
            $elements = $elements->renderToString();
        }

        $elements = Element::replaceSystemChars($elements);

        return ($callback === null) ? $elements : call_user_func($callback, $elements);
    }

    /**
     * Render elements to the file.
     * 
     * @param string|Element $elements Elements.
     * @param                $filePath File path.
     *
     * @access public
     */
    public static function renderToFile($elements, string $filePath, ?callable $callback = null): void 
    {
        if ($elements instanceof Element) {
            $elements = $elements->renderToString();
        }

        $elements = Element::replaceSystemChars($elements);

        file_put_contents($filePath, ($callback === null) ? $elements : call_user_func($callback, $elements));
    }
}
