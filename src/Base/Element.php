<?php

declare(strict_types=1);

namespace Termage\Base;

use Atomastic\Arrays\Arrays;
use Atomastic\Strings\Strings;
use BadMethodCallException;
use Termage\Themes\ThemeInterface;
use Termage\Themes\Theme;
use Termage\Utils\Color;
use Termage\Parsers\Shortcodes;

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
     * @param Theme           $theme      Instance of the Theme class.
     * @param string          $value      Element value.
     * @param array           $properties Element properties.
     *
     * @return Element Returns element.
     *
     * @access public
     */
    final public function __construct(
        $theme = null,
        $shortcodes = null,
        string $value = '',
        string $class = ''
    ) {
        self::$theme      = $theme ?? new Theme();
        self::$shortcodes = $shortcodes ?? new Shortcodes(self::getTheme());
        $this->value      = $value;
        $this->class      = strings($class)->trim();
        $this->properties = arrays();
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
     * Set element bold property.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function bold(): self
    {
        $this->properties->set('bold', true);

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
        $this->properties->set('italic', true);

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
        $this->properties->set('strikethrough', true);

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
        $this->properties->set('dim', true);

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
        $this->properties->set('underline', true);

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
        $this->properties->set('blink', true);

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
        $this->properties->set('reverse', true);

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
        $this->properties->set('invisible', true);

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
        $this->properties->set('color', $color);

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
        $this->properties->set('bg', $color);

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

        $this->properties->set('margin.left', intval($value / 2 * $themeMarginLeft * $themeMarginGlobal));
        $this->properties->set('margin.right', intval($value / 2 * $themeMarginRight * $themeMarginGlobal));

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

        $this->properties->set('margin.left', intval($value * $themeMarginLeft * $themeMarginGlobal));

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

        $this->properties->set('margin.right', intval($value * $themeMarginRight * $themeMarginGlobal));

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

        $this->properties->set('padding.left', intval($value / 2 * $themePaddingLeft * $themePaddingGlobal));
        $this->properties->set('padding.right', intval($value / 2 * $themePaddingRight * $themePaddingGlobal));

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

        $this->properties->set('padding.left', intval($value * $themePaddingLeft * $themePaddingGlobal));

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

        $this->properties->set('padding.right', intval($value * $themePaddingRight * $themePaddingGlobal));

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
        if (strings($method)->startsWith('display')) {
            return $this->display(strings(substr($method, 7))->lower()->toString());
        }

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
     * Get rendered element.
     *
     * @return string Returns rendered element.
     * 
     * @access public
     */
    public function render(): string
    {
        // Apply classes
        if ($this->class->length() > 0) {
            foreach ($this->class->segments() as $class) {
                $this->{(string) strings($class)->camel()->trim()}();
            }
        }

        $propertiesHierarchy = ['invisible', 'reverse', 'blink', 'dim', 'bold', 'italic', 'underline', 'strikethrough', 'padding', 'bg', 'color', 'margin'];

        $properties = [
            'padding'       => ['l' => $this->properties->get('padding.left') ?? 0, 'r' => $this->properties->get('padding.right') ?? 0],
            'margin'        => ['l' => $this->properties->get('margin.left') ?? 0, 'r' => $this->properties->get('margin.right') ?? 0],
            'color'         => $this->properties->get('color') ? self::$theme->variables()->get('colors.' . $this->properties->get('color'), $this->properties->get('color')) : false,
            'bg'            => $this->properties->get('bg') ? self::$theme->variables()->get('bg.' . $this->properties->get('bg'), $this->properties->get('bg')) : false,
            'bold'          => $this->properties->get('bold') ?? false,
            'italic'        => $this->properties->get('italic') ?? false,
            'underline'     => $this->properties->get('underline') ?? false,
            'strikethrough' => $this->properties->get('strikethrough') ?? false,
            'dim'           => $this->properties->get('dim') ?? false,
            'blink'         => $this->properties->get('blink') ?? false,
            'reverse'       => $this->properties->get('reverse') ?? false,
            'invisible'     => $this->properties->get('invisible') ?? false,
        ];

        $padding       = static fn ($value) => strings(' ')->repeat($properties['padding']['l']) . $value . strings(' ')->repeat($properties['padding']['r']);
        $margin        = static fn ($value) => strings(' ')->repeat($properties['margin']['l']) . $value . strings(' ')->repeat($properties['margin']['r']);
        $color         = static fn ($value) => $properties['color'] ? (new Color())->textColor($properties['color'])->apply($value) : $value;
        $bg            = static fn ($value) => $properties['bg'] ? (new Color())->bgColor($properties['bg'])->apply($value) : $value;
        $bold          = static fn ($value) => $properties['bold'] ? "\e[1m" . $value . "\e[22m" : $value;
        $italic        = static fn ($value) => $properties['italic'] ? "\e[3m" . $value . "\e[23m" : $value;
        $underline     = static fn ($value) => $properties['underline'] ? "\e[4m" . $value . "\e[24m" : $value;
        $strikethrough = static fn ($value) => $properties['strikethrough'] ? "\e[9m" . $value . "\e[29m" : $value;
        $dim           = static fn ($value) => $properties['dim'] ? "\e[2m" . $value . "\e[22m" : $value;
        $blink         = static fn ($value) => $properties['blink'] ? "\e[5m" . $value . "\e[25m" : $value;
        $reverse       = static fn ($value) => $properties['reverse'] ? "\e[7m" . $value . "\e[27m" : $value;
        $invisible     = static fn ($value) => $properties['invisible'] ? "\e[8m" . $value . "\e[28m" : $value;
    
        foreach($propertiesHierarchy as $propertyName) {
            $this->value = ${$propertyName}($this->value);
        }
        
        return self::$shortcodes->parse($this->value);
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
