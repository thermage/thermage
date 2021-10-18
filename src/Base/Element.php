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
 * @link      https://digital.flextype.org/termage/ Termage
 */

namespace Termage\Base;

use Atomastic\Strings\Strings;
use Atomastic\Arrays\Arrays;
use BadMethodCallException;
use Termage\Parsers\Shortcodes;
use Termage\Themes\Theme;
use Termage\Themes\ThemeInterface;
use Termage\Utils\Color;

use function arrays;
use function intval;
use function sprintf;
use function strings;
use function substr;

abstract class Element
{
    /**
     * Element value.
     *
     * @access private
     */
    private string $value;

    /**
     * Element classes.
     *
     * @access private
     */
    private string $classes;

    /**
     * Element styles.
     *
     * @access private
     */
    private Arrays $styles;

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
     * Create a new Element instance.
     *
     * @param        $theme 
     * @param        $shortcodes 
     * @param string $value   Element value.
     * @param string $classes Element classes.
     *
     * @return Element Returns element.
     *
     * @access public
     */
    final public function __construct(
        $theme = null,
        $shortcodes = null,
        string $value = '',
        string $classes = ''
    ) {
        self::$theme      = $theme ??= new Theme();
        self::$shortcodes = $shortcodes ??= new Shortcodes(self::getTheme());
        $this->value      = $value;
        $this->classes    = trim($classes);
        $this->styles     = arrays();
    }

    /**
     * Get element value.
     *
     * @return Strings Returns element value.
     *
     * @access public
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Set element value.
     *
     * @param string $value Element value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function setValue(string $value = ''): self
    {
        $this->value = $value;

        return $this;
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
        return self::$theme ??= new Theme();
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
     * Set element bold property.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function bold(): self
    {
        $this->styles->set('bold', true);

        return $this;
    }

    /**
     * Set element italic property.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function italic(): self
    {
        $this->styles->set('italic', true);

        return $this;
    }

    /**
     * Set element strikethrough property.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function strikethrough(): self
    {
        $this->styles->set('strikethrough', true);

        return $this;
    }

    /**
     * Set element dim property.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function dim(): self
    {
        $this->styles->set('dim', true);

        return $this;
    }

    /**
     * Set element underline property, alias to underscore.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function underline(): self
    {
        $this->styles->set('underline', true);

        return $this;
    }

    /**
     * Set element blink property.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function blink(): self
    {
        $this->styles->set('blink', true);

        return $this;
    }

    /**
     * Set element reverse property.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function reverse(): self
    {
        $this->styles->set('reverse', true);

        return $this;
    }

    /**
     * Set element invisible property.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function invisible(): self
    {
        $this->styles->set('invisible', true);

        return $this;
    }

    /**
     * Set element color.
     *
     * @param string $color Element color.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function color(string $color): self
    {
        $this->styles->set('color', $color);

        return $this;
    }

    /**
     * Set element background color.
     *
     * @param string $color Element background color.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function bg(string $color): self
    {
        $this->styles->set('bg', $color);

        return $this;
    }

    /**
     * Set element margin x property.
     *
     * @param int $value Margin x.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function mx(int $value): self
    {
        $themeMarginGlobal = self::$theme->variables()->get('margin.global', 1);
        $themeMarginLeft   = self::$theme->variables()->get('margin.left', 1);
        $themeMarginRight  = self::$theme->variables()->get('margin.right', 1);

        $this->styles->set('margin.left', intval($value / 2 * $themeMarginLeft * $themeMarginGlobal));
        $this->styles->set('margin.right', intval($value / 2 * $themeMarginRight * $themeMarginGlobal));

        return $this;
    }

    /**
     * Set element margin left property.
     *
     * @param int $value Margin left.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function ml(int $value): self
    {
        $themeMarginGlobal = self::$theme->variables()->get('margin.global', 1);
        $themeMarginLeft   = self::$theme->variables()->get('margin.left', 1);

        $this->styles->set('margin.left', intval($value * $themeMarginLeft * $themeMarginGlobal));

        return $this;
    }

    /**
     * Set element margin right property.
     *
     * @param int $value Margin right.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function mr(int $value): self
    {
        $themeMarginGlobal = self::$theme->variables()->get('margin.global', 1);
        $themeMarginRight  = self::$theme->variables()->get('margin.right', 1);

        $this->styles->set('margin.right', intval($value * $themeMarginRight * $themeMarginGlobal));

        return $this;
    }

    /**
     * Set element padding x property.
     *
     * @param int $value Padding x.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function px(int $value): self
    {
        $themePaddingGlobal = self::$theme->variables()->get('padding.global', 1);
        $themePaddingLeft   = self::$theme->variables()->get('padding.left', 1);
        $themePaddingRight  = self::$theme->variables()->get('padding.right', 1);

        $this->styles->set('padding.left', intval($value / 2 * $themePaddingLeft * $themePaddingGlobal));
        $this->styles->set('padding.right', intval($value / 2 * $themePaddingRight * $themePaddingGlobal));

        return $this;
    }

    /**
     * Set element padding left property.
     *
     * @param int $value Padding left.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function pl(int $value): self
    {
        $themePaddingGlobal = self::$theme->variables()->get('padding.global', 1);
        $themePaddingLeft   = self::$theme->variables()->get('padding.left', 1);

        $this->styles->set('padding.left', intval($value * $themePaddingLeft * $themePaddingGlobal));

        return $this;
    }

    /**
     * Set element padding right property.
     *
     * @param int $value Padding right.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function pr(int $value): self
    {
        $themePaddingGlobal = self::$theme->variables()->get('padding.global', 1);
        $themePaddingRight  = self::$theme->variables()->get('padding.right', 1);

        $this->styles->set('padding.right', intval($value * $themePaddingRight * $themePaddingGlobal));

        return $this;
    }

    /**
     * Dynamically bind magic methods to the Element class.
     *
     * @param string $method     Method.
     * @param array  $parameters Parameters.
     *
     * @return mixed Returns mixed content.
     *
     * @throws BadMethodCallException If method not found.
     *
     * @access public
     */
    public function __call(string $method, array $parameters)
    {
        if (strings($method)->startsWith('bg')) {
            return $this->bg(strings(substr($method, 2))->kebab()->toString());
        }

        if (strings($method)->startsWith('color')) {
            return $this->color(strings(substr($method, 5))->kebab()->toString());
        }

        if (strings($method)->startsWith('mx')) {
            return $this->mx(strings(substr($method, 2))->toInteger());
        }

        if (strings($method)->startsWith('ml')) {
            return $this->ml(strings(substr($method, 2))->toInteger());
        }

        if (strings($method)->startsWith('mr')) {
            return $this->mr(strings(substr($method, 2))->toInteger());
        }

        if (strings($method)->startsWith('px')) {
            return $this->px(strings(substr($method, 2))->toInteger());
        }

        if (strings($method)->startsWith('pl')) {
            return $this->pl(strings(substr($method, 2))->toInteger());
        }

        if (strings($method)->startsWith('pr')) {
            return $this->pr(strings(substr($method, 2))->toInteger());
        }

        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.',
            static::class,
            $method
        ));
    }

    /** 
     * Process classes.
     * 
     * @access public
     * 
     * @return void
     */
    public function processClasses(): void
    {
        $classes = strings($this->classes);
        if ($classes->length() > 0) {
            foreach ($classes->segments() as $class) {
                $this->{(string) strings($class)->camel()->trim()}();
            }
        }
    }

    /** 
     * Process styles for element value.
     * 
     * @access public
     * 
     * @return void
     */
    public function processStyles(): void
    {
        $stylesHierarchy = ['invisible', 'reverse', 'blink', 'dim', 'bold', 'italic', 'underline', 'strikethrough', 'padding', 'bg', 'color', 'margin'];

        $styles = [
            'padding'       => ['l' => $this->styles->get('padding.left') ?? 0, 'r' => $this->styles->get('padding.right') ?? 0],
            'margin'        => ['l' => $this->styles->get('margin.left') ?? 0, 'r' => $this->styles->get('margin.right') ?? 0],
            'color'         => $this->styles->get('color') ? self::$theme->variables()->get('colors.' . $this->styles->get('color'), $this->styles->get('color')) : false,
            'bg'            => $this->styles->get('bg') ? self::$theme->variables()->get('colors.' . $this->styles->get('bg'), $this->styles->get('bg')) : false,
            'bold'          => $this->styles->get('bold') ?? false,
            'italic'        => $this->styles->get('italic') ?? false,
            'underline'     => $this->styles->get('underline') ?? false,
            'strikethrough' => $this->styles->get('strikethrough') ?? false,
            'dim'           => $this->styles->get('dim') ?? false,
            'blink'         => $this->styles->get('blink') ?? false,
            'reverse'       => $this->styles->get('reverse') ?? false,
            'invisible'     => $this->styles->get('invisible') ?? false,
        ];

        $padding       = static fn ($value) => strings(' ')->repeat($styles['padding']['l']) . $value . strings(' ')->repeat($styles['padding']['r']);
        $margin        = static fn ($value) => strings(' ')->repeat($styles['margin']['l']) . $value . strings(' ')->repeat($styles['margin']['r']);
        $color         = static fn ($value) => $styles['color'] ? (new Color())->textColor($styles['color'])->apply($value) : $value;
        $bg            = static fn ($value) => $styles['bg'] ? (new Color())->bgColor($styles['bg'])->apply($value) : $value;
        $bold          = static fn ($value) => $styles['bold'] ? "\e[1m" . $value . "\e[22m" : $value;
        $italic        = static fn ($value) => $styles['italic'] ? "\e[3m" . $value . "\e[23m" : $value;
        $underline     = static fn ($value) => $styles['underline'] ? "\e[4m" . $value . "\e[24m" : $value;
        $strikethrough = static fn ($value) => $styles['strikethrough'] ? "\e[9m" . $value . "\e[29m" : $value;
        $dim           = static fn ($value) => $styles['dim'] ? "\e[2m" . $value . "\e[22m" : $value;
        $blink         = static fn ($value) => $styles['blink'] ? "\e[5m" . $value . "\e[25m" : $value;
        $reverse       = static fn ($value) => $styles['reverse'] ? "\e[7m" . $value . "\e[27m" : $value;
        $invisible     = static fn ($value) => $styles['invisible'] ? "\e[8m" . $value . "\e[28m" : $value;

        foreach ($stylesHierarchy as $propertyName) {
            $this->value = ${$propertyName}($this->value);
        }
    }

    /** 
     * Process shortcodes for element value.
     * 
     * @access public
     * 
     * @return void
     */
    public function processShortcodes(): void
    {
        $this->value = self::$shortcodes->parse($this->value);
    }

    /** 
     * Strip styles.
     * 
     * @param string $value Value with styles.
     * 
     * @access public
     * 
     * @return string Value without styles.
     */
    public function stripStyles(string $value): string
    {
        return preg_replace("/\e\[[^m]*m/", '', $value ?? '');
    }

    /** 
     * Strip all decorations.
     * 
     * @param string $value Value with decorations.
     * 
     * @access public
     * 
     * @return string Value without decorations.
     */
    public function stripDecorations($value): string
    {
        return self::getShortcodes()->stripShortcodes($this->stripStyles($value));
    }

    /**
     * Get rendered element.
     *
     * @return string Returns rendered element.
     *
     * @access public
     */
    public function render(): string
    {
        $this->processClasses();
        $this->processStyles();
        $this->processShortcodes();
 
        return $this->value;
    }

    /**
     * Get rendered element as string representation.
     *
     * @return string Returns rendered element as string representation.
     *
     * @access public
     */
    public function __toString(): string
    {
        return $this->render();
    }
}
