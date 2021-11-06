<?php

declare(strict_types=1);

/**
 * Termage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/termage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License.
 *
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 */

namespace Termage\Base;

use Atomastic\Arrays\Arrays as Collection;
use Atomastic\Strings\Strings;
use BadMethodCallException;
use Termage\Parsers\Shortcodes;
use Termage\Themes\Theme;
use Termage\Themes\ThemeInterface;

use function abs;
use function arrays as collection;
use function intval;
use function is_null;
use function preg_replace;
use function sprintf;
use function strings;
use function Termage\color;
use function Termage\terminal;

use const PHP_EOL;

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
    private Collection $styles;

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
     * Registered element classes.
     */
    private Collection $registeredClasses;

    /**
     * Force element to self-clear its children block elements linebreaks.
     *
     * @access private
     */
    private bool $clearfix;

    /**
     * Create a new Element instance.
     *
     * @param        $theme
     * @param        $shortcodes
     * @param string     $value   Element value.
     * @param string     $classes Element classes.
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
        self::$theme             = $theme ??= new Theme();
        self::$shortcodes        = $shortcodes ??= new Shortcodes(self::getTheme());
        $this->value             = $value;
        $this->classes           = $classes;
        $this->registeredClasses = collection($this->getDefaultClasses())->merge($this->getElementClasses(), true);
        $this->styles            = collection();
        $this->clearfix          = false;
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
    public function value(string $value = ''): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get element styles.
     *
     * @return Collection Returns element styles.
     *
     * @access public
     */
    public function getStyles(): Collection
    {
        return $this->styles;
    }

    /**
     * Set element styles.
     *
     * @param string $styles Element styles.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function styles(array $styles = []): self
    {
        $this->styles = collection($styles);

        return $this;
    }

    /**
     * Get element classes.
     *
     * @return string Returns Element classes.
     *
     * @access public
     */
    public function getClasses(): string
    {
        return $this->classes;
    }

    /**
     * Set element classes.
     *
     * @param string $classes Element classes.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function classes(string $classes = ''): self
    {
        $this->classes = $classes;

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
     * Get default element classes.
     *
     * @return array Array of default classes.
     *
     * @access public
     */
    final public function getDefaultClasses(): array
    {
        return ['bold', 'italic', 'bg', 'color', 'pl', 'pr', 'px', 'ml', 'mr', 'mx', 'dim', 'invisible', 'underline', 'reverse', 'blink', 'w', 'd', 'text-align', 'clearfix'];
    }

    /**
     * Get element classes.
     *
     * @return array Array of element classes.
     *
     * @access public
     */
    public function getElementClasses(): array
    {
        return [];
    }

    /**
     * Set element bold style.
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
     * Set element italic style.
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
     * Set element strikethrough style.
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
     * Set element dim style.
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
     * Set element underline style.
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
     * Set element blink style.
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
     * Set element reverse style.
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
     * Set element invisible style.
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
     * Set element text color style.
     *
     * @param string $color Element text color value.
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
     * Set element background color style.
     *
     * @param string $color Element background color value.
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
     * Set element margin top, right, bottom, left style.
     *
     * @param int      $top    Margin top value.
     * @param int|null $right  Margin right value.
     * @param int|null $bottom Margin bottom value.
     * @param int|null $left   Margin left value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function m(int $top, ?int $right = null, ?int $bottom = null, ?int $left = null): self
    {
        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        if (is_null($right) && is_null($bottom) && is_null($left)) {
            $right  = $top;
            $bottom = $top;
            $left   = $top;
        }

        $this->styles->set('margin.top', intval($top * $themeSpacer));
        $this->styles->set('margin.right', intval($right * $themeSpacer));
        $this->styles->set('margin.bottom', intval($bottom * $themeSpacer));
        $this->styles->set('margin.left', intval($left * $themeSpacer));

        return $this;
    }

    /**
     * Set element margin x style.
     *
     * @param int $value Margin x value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function mx(int $value): self
    {
        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $this->styles->set('margin.left', intval($value * $themeSpacer));
        $this->styles->set('margin.right', intval($value * $themeSpacer));

        return $this;
    }

    /**
     * Set element margin y style.
     *
     * @param int $value Margin y value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function my(int $value): self
    {
        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $this->styles->set('margin.top', intval($value * $themeSpacer));
        $this->styles->set('margin.bottom', intval($value * $themeSpacer));

        return $this;
    }

    /**
     * Set element margin left style.
     *
     * @param int $value Margin left value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function ml(int $value): self
    {
        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $this->styles->set('margin.left', intval($value * $themeSpacer));

        return $this;
    }

    /**
     * Set element margin right style.
     *
     * @param int $value Margin right value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function mr(int $value): self
    {
        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $this->styles->set('margin.right', intval($value * $themeSpacer));

        return $this;
    }

    /**
     * Set element padding x style.
     *
     * @param int $value Padding x value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function px(int $value): self
    {
        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $this->styles->set('padding.left', intval($value * $themeSpacer));
        $this->styles->set('padding.right', intval($value * $themeSpacer));

        return $this;
    }

    /**
     * Set element padding left and right style.
     *
     * @param int $left Padding left value.
     * @param int $left Padding right value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function p(int $left, int $right): self
    {
        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $this->styles->set('padding.left', intval($left * $themeSpacer));
        $this->styles->set('padding.right', intval($right * $themeSpacer));

        return $this;
    }

    /**
     * Set element padding left style.
     *
     * @param int $value Padding left value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function pl(int $value): self
    {
        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $this->styles->set('padding.left', intval($value * $themeSpacer));

        return $this;
    }

    /**
     * Set element padding right style.
     *
     * @param int $value Padding right value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function pr(int $value): self
    {
        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $this->styles->set('padding.right', intval($value * $themeSpacer));

        return $this;
    }

    /**
     * Set element text align style.
     *
     * @param mixed $value Text align value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function textAlign(string $value): self
    {
        $this->styles->set('text-align', $value);

        return $this;
    }

    /**
     * Set element width style.
     *
     * @param mixed $value Width value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function w($value): self
    {
        $this->styles->set('width', $value);

        return $this;
    }

    /**
     * Set element display style.
     *
     * @param string $value Display value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function d(string $value): self
    {
        $this->styles->set('display', $value);

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
            return $this->bg(strings($method)->substr(2)->kebab()->toString());
        }

        if (strings($method)->startsWith('color')) {
            return $this->color(strings($method)->substr(5)->kebab()->toString());
        }

        if (strings($method)->startsWith('m')) {
            if (strings($method)->startsWith('mx')) {
                return $this->mx(strings($method)->substr(2)->toInteger());
            }

            if (strings($method)->startsWith('my')) {
                return $this->my(strings($method)->substr(2)->toInteger());
            }

            if (strings($method)->startsWith('ml')) {
                return $this->ml(strings($method)->substr(2)->toInteger());
            }

            if (strings($method)->startsWith('mr')) {
                return $this->mr(strings($method)->substr(2)->toInteger());
            }

            if (strings($method)->substr(1)->toInteger()) {
                return $this->m(strings($method)->substr(1)->toInteger());
            }

            return $this->m(...$parameters);
        }

        if (strings($method)->startsWith('p')) {
            if (strings($method)->startsWith('px')) {
                return $this->px(strings($method)->substr(2)->toInteger());
            }

            if (strings($method)->startsWith('pl')) {
                return $this->pl(strings($method)->substr(2)->toInteger());
            }

            if (strings($method)->startsWith('pr')) {
                return $this->pr(strings($method)->substr(2)->toInteger());
            }

            return $this->p(...$parameters);
        }

        if (strings($method)->startsWith('d')) {
            return $this->d(strings($method)->substr(1)->kebab()->toString());
        }

        if (strings($method)->startsWith('textAlign')) {
            return $this->textAlign(strings($method)->substr(9)->kebab()->toString());
        }

        if (strings($method)->startsWith('w')) {
            if ($method === 'wAuto') {
                return $this->w('auto');
            }

            if ($method === 'fixBlock') {
                return $this->fixBlock();
            }

            return $this->w(strings($method)->substr(1)->toInteger());
        }

        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.',
            static::class,
            $method
        ));
    }

    /**
     * Force element to self-clear its children block elements linebreaks.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function clearfix(): self
    {
        $this->clearfix = true;

        return $this;
    }

    /**
     * Process element classes.
     *
     * @access public
     */
    public function processClasses(): void
    {
        $classes = strings($this->classes)->trim();

        if ($classes->length() <= 0) {
            return;
        }

        foreach ($classes->segments() as $class) {
            $methodName = (string) strings($class)->camel()->trim();
            foreach ($this->registeredClasses->toArray() as $registeredClass) {
                $registeredClassName = (string) strings($registeredClass)->camel()->trim();

                if (! strings($methodName)->startsWith($registeredClassName)) {
                    continue;
                }

                $this->{$methodName}();
            }
        }
    }

    /**
     * Process styles for element value.
     *
     * @access public
     */
    public function processStyles(): void
    {
        // Termage box model and styles hierarchy.
        //
        // ┌───────────────────────────────────────────────────────┐
        // │ display [inline, block, none]                         │
        // │ ┌───────────────────────────────────────────────────┐ │
        // │ │ margin (top, right, bottom, left)                 │ │
        // │ │ ┌───────────────────────────────────────────────┐ │ │
        // │ │ │ bg, color                                     │ │ │
        // │ │ │ ┌───────────────────────────────────────────┐ │ │ │
        // │ │ │ │ width (+ left and right padding)          │ │ │ │
        // │ │ │ │ ┌───────────────────────────────────────┐ │ │ │ │
        // │ │ │ │ │ invisible, reverse, blink, dim, bold, │ │ │ │ │
        // │ │ │ │ │ italic, underline, strikethrough.     │ │ │ │ │
        // │ │ │ │ └───────────────────────────────────────┘ │ │ │ │
        // │ │ │ └───────────────────────────────────────────┘ │ │ │
        // | | └───────────────────────────────────────────────┘ │ │
        // │ └───────────────────────────────────────────────────┘ │
        // └───────────────────────────────────────────────────────┘
        $stylesHierarchy = ['invisible', 'reverse', 'blink', 'dim', 'bold', 'italic', 'underline', 'strikethrough', 'width', 'bg', 'color', 'margin', 'display'];

        // Process style: margin
        $margin = function ($value) {
            $ml = $this->styles->get('margin.left') ?? 0;
            $mr = $this->styles->get('margin.right') ?? 0;
            $mt = $this->styles->get('margin.top') ?? 0;
            $mb = $this->styles->get('margin.bottom') ?? 0;

            // Do not allow margins for block elements with clearfix flag.
            if ($this->clearfix) {
                return $value;
            }

            // Do not allow vertical margins for inline elements.
            if ($this->styles->get('display') == 'inline') {
                $mt = 0;
                $mb = 0;
            }

            return ($mt > 0 ? strings(PHP_EOL)->repeat($mt) : '') .
                   ($ml > 0 ? strings(' ')->repeat($ml) : '') .
                   $value .
                   ($mr > 0 ? strings(' ')->repeat($mr) : '') .
                   ($mb > 0 ? strings(PHP_EOL)->repeat($mb) : '');
        };

        // Process style: width
        // based on element paddings (spaces)
        $width = function ($value) {
            $valueLength    = $this->getLength($value);
            $textAlignStyle = $this->styles->get('text-align') ?? 'left';
            $widthStyle     = $this->styles->get('width') ?? 'auto';
            $displayStyle   = $this->styles->get('display') ?? 'block';
            $pl             = $this->styles->get('padding.left') ?? 0;
            $pr             = $this->styles->get('padding.right') ?? 0;
            $spaces         = 0;

            if ($widthStyle === 'auto' && $displayStyle === 'block') {
                $spaces = abs(terminal()->getwidth() - $valueLength);

                // Do not allow width for block elements with clearfix flag.
                if ($this->clearfix) {
                    return $value;
                }

                if ($textAlignStyle === 'left') {
                    return strings(' ')->repeat($pl) . $value . strings(' ')->repeat($spaces - $pl);
                }

                if ($textAlignStyle === 'right') {
                    return strings(' ')->repeat($spaces - $pr) . $value . strings(' ')->repeat($pr);
                }

                if ($textAlignStyle === 'center') {
                    $leftSpaces  = intval($spaces / 2);
                    $rightSpaces = intval($spaces / 2);

                    if (intval($leftSpaces * 2) < $spaces) {
                        $leftSpaces++;
                    }

                    return strings(' ')->repeat($leftSpaces) . $value . strings(' ')->repeat($rightSpaces);
                }
            }

            if ($widthStyle !== 'auto' && $displayStyle === 'block') {
                $spaces = $widthStyle - $valueLength < $valueLength ? 0 : $widthStyle - $valueLength;

                if ($textAlignStyle === 'left') {
                    return strings(' ')->repeat($pl) . $value . strings(' ')->repeat($spaces + $pr);
                }

                if ($textAlignStyle === 'right') {
                    return strings(' ')->repeat($spaces + $pl) . $value . strings(' ')->repeat($pr);
                }

                if ($textAlignStyle === 'center') {
                    $leftSpaces  = intval($spaces / 2);
                    $rightSpaces = intval($spaces / 2);

                    if (intval($leftSpaces * 2) < $spaces) {
                        $leftSpaces++;
                    }

                    return strings(' ')->repeat($leftSpaces + $pl) . $value . strings(' ')->repeat($rightSpaces + $pr);
                }
            }

            if ($displayStyle === 'inline') {
                return strings(' ')->repeat($pl) . $value . strings(' ')->repeat($pr);
            }
        };

        // Process style: color
        $color = function ($value) {
            $color = $this->styles->get('color') ? self::$theme->getVariables()->get('colors.' . $this->styles->get('color'), $this->styles->get('color')) : false;

            return $color ? color()->textColor($color)->apply($value) : $value;
        };

        // Process style: bg
        $bg = function ($value) {
            $bg = $this->styles->get('bg') ? self::$theme->getVariables()->get('colors.' . $this->styles->get('bg'), $this->styles->get('bg')) : false;

            return $bg ? color()->bgColor($bg)->apply($value) : $value;
        };

        // Process style: bold
        $bold = function ($value) {
            return $this->styles['bold'] ? "\e[1m" . $value . "\e[22m" : $value;
        };

        // Process style: italic
        $italic = function ($value) {
            return $this->styles['italic'] ? "\e[3m" . $value . "\e[23m" : $value;
        };

        // Process style: underline
        $underline = function ($value) {
            return $this->styles['underline'] ? "\e[4m" . $value . "\e[24m" : $value;
        };

        // Process style: strikethrough
        $strikethrough = function ($value) {
            return $this->styles['strikethrough'] ? "\e[9m" . $value . "\e[29m" : $value;
        };

        // Process style: dim
        $dim = function ($value) {
            return $this->styles['dim'] ? "\e[2m" . $value . "\e[22m" : $value;
        };

        // Process style: blink
        $blink = function ($value) {
            return $this->styles['blink'] ? "\e[5m" . $value . "\e[25m" : $value;
        };

        // Process style: reverse
        $reverse = function ($value) {
            return $this->styles['reverse'] ? "\e[7m" . $value . "\e[27m" : $value;
        };

        // Process style: invisible
        $invisible = function ($value) {
            return $this->styles['invisible'] ? "\e[8m" . $value . "\e[28m" : $value;
        };

        // Process style: display
        $display = function ($value) {
            $displayStyle = $this->styles->get('display') ?? 'block';

            switch ($displayStyle) {
                case 'inline':
                    return $value;

                    break;
                case 'none':
                    return '';

                    break;
                case 'block':
                default:
                    // Do not add linebreak for block elements if it has clearfix flag.
                    if ($this->clearfix) {
                        $result = $value;
                    } else {
                        $result = $value . PHP_EOL;
                    }

                    return $result;

                    break;
            }
        };

        // Process styles accorind to box model based on styles hierarchy.
        foreach ($stylesHierarchy as $propertyName) {
            $this->value = ${$propertyName}($this->value);
        }
    }

    /**
     * Process shortcodes for element value.
     *
     * @access public
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
     * @return string Value without styles.
     *
     * @access public
     */
    public function stripStyles(string $value): string
    {
        return preg_replace("/\e\[[^m]*m/", '', $value);
    }

    /**
     * Strip all decorations.
     *
     * @param string $value Value with decorations.
     *
     * @return string Value without decorations.
     *
     * @access public
     */
    public function stripDecorations(string $value): string
    {
        return self::getShortcodes()->stripShortcodes($this->stripStyles($value));
    }

    /**
     * Get value length without decorations and line breaks.
     *
     * @param string $value Value.
     *
     * @return int Value length without decorations and line breaks.
     *
     * @access public
     */
    public function getLength(string $value): int
    {
        return strings($this->stripDecorations($value))->replace(PHP_EOL, '')->length();
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
