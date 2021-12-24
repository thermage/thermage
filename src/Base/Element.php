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

namespace Thermage\Base;

use Glowy\Arrays\Arrays as Collection;
use Glowy\Strings\Strings;
use BadMethodCallException;
use Exception;
use Thermage\Parsers\Shortcodes;
use Thermage\Themes\Theme;
use Thermage\Themes\ThemeInterface;
use Thermage\Base\Color;
use Thermage\Base\Terminal;

use function abs;
use function arrays as collection;
use function intval;
use function is_null;
use function preg_replace;
use function sprintf;
use function strings;
use function Thermage\getEsc;

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
        string $classes = '',
        array  $styles = []
    ) {
        self::$theme             = $theme ??= new Theme();
        self::$shortcodes        = $shortcodes ??= new Shortcodes(self::getTheme());
        $this->value             = $value;
        $this->classes           = $classes;
        $this->registeredClasses = collection($this->getDefaultClasses())->merge($this->getElementClasses(), true);
        $this->styles            = collection($styles);
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
        return [
            'bold',
            'italic',
            'bg',
            'color',
            'colors',
            'font',
            'font-letter-spacing',
            'dim',
            'strikethrough',
            'invisible',
            'underline',
            'reverse',
            'blink',
            'text-align',
            'text-align-vertical',
            'text-overflow',
            'clearfix',
            'border',
            'border-color',
            'p',
            'pl',
            'pr',
            'px',
            'py',
            'pt',
            'pb',
            'm',
            'ml',
            'mr',
            'mx',
            'my',
            'mt',
            'mb',
            'w',
            'h',
            'd',
        ];
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
     * Set element maring style.
     *
     * @param mixed $values Margins [top, right, bottom, left].
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function m(...$values): self
    {
        list($top, $right, $bottom, $left) = array_merge($values, [null, null, null, null]);

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
     * Set element margin top style.
     *
     * @param int $value Margin top value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function mt(int $value): self
    {
        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $this->styles->set('margin.top', intval($value * $themeSpacer));

        return $this;
    }

    /**
     * Set element margin bottom style.
     *
     * @param int $value Margin bottom value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function mb(int $value): self
    {
        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

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
     * Set element padding y style.
     *
     * @param int $value Padding y value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function py(int $value): self
    {
        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $this->styles->set('padding.top', intval($value * $themeSpacer));
        $this->styles->set('padding.bottom', intval($value * $themeSpacer));

        return $this;
    }

    /**
     * Set element padding top style.
     *
     * @param int $value Padding top value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function pt(int $value): self
    {
        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $this->styles->set('padding.top', intval($value * $themeSpacer));

        return $this;
    }

    /**
     * Set element padding bottom style.
     *
     * @param int $value Padding bottom value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function pb(int $value): self
    {
        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        $this->styles->set('padding.bottom', intval($value * $themeSpacer));

        return $this;
    }

    /**
     * Set element padding style.
     *
     * @param mixed $values Paddings [top, right, bottom, left].
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function p(...$values): self
    {
        list($top, $right, $bottom, $left) = array_merge($values, [null, null, null, null]);

        $themeSpacer = self::$theme->getVariables()->get('spacer', 1);

        if (is_null($right) && is_null($bottom) && is_null($left)) {
            $right  = $top;
            $bottom = $top;
            $left   = $top;
        }

        $this->styles->set('padding.top', intval($top * $themeSpacer));
        $this->styles->set('padding.right', intval($right * $themeSpacer));
        $this->styles->set('padding.bottom', intval($bottom * $themeSpacer));
        $this->styles->set('padding.left', intval($left * $themeSpacer));

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
     * Set element text align vertical style.
     *
     * @param mixed $value Text align vertical value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function textAlignVertical(string $value): self
    {
        $this->styles->set('text-align-vertical', $value);

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
     * Set element height style.
     *
     * @param mixed $value Height value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function h($value): self
    {
        $this->styles->set('height', $value);

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
     * Set element border style.
     *
     * @param string $value Border style value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function border(string $value): self
    {
        $this->styles->set('border', $value);

        return $this;
    }

    /**
     * Set element border color style.
     *
     * @param string $value Border color style value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function borderColor(string $value): self
    {
        $this->styles->set('border-color', $value);

        return $this;
    }

    /**
     * Set element colors style.
     *
     * @param string $values Colors style values.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function colors(string ...$values): self
    {
        $this->styles->set('colors', $values);

        return $this;
    }

    /**
     * Set element font style.
     *
     * @param string $value Font style value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function font(string $value): self
    {
        $fontFile = __DIR__ . '/../../fonts/' . $value . '.json';

        if (! file_exists($fontFile)) {
            throw new Exception("Font {$value} not found.");
        }

        $this->styles->set('font', json_decode(file_get_contents($fontFile), true));
        
        return $this; 
    }

    /**
     * Set element font style from not default fonts.
     *
     * @param string $value Font style value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function fontFrom(string $value): self
    {
        $fontFile = $value . '.json';

        if (! file_exists($fontFile)) {
            throw new Exception("Font {$value} not found.");
        }

        $this->styles->set('font', json_decode(file_get_contents($fontFile), true));
        
        return $this; 
    }

    /**
     * Set element font letter spacing style.
     *
     * @param int $value Font letter spacing style value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function fontLetterSpacing(int $value): self
    {
        $this->styles->set('font-letter-spacing', $value);
        
        return $this; 
    }

    /**
     * Apply elemnt style for element value.
     *
     * @param string $value Element value.
     *
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function applyFont(string $value): string
    {
        if (!$this->styles->has('font')) {
            return $value;
        }

        $chars = [];
        $colorsTags = [];
        $colorsValues = [];
        $result = '';

        foreach(strings($value)->upper()->chars() as $char) {
            $chars[] = $this->styles->get('font.chars.' . $char);
        }

        $charsCount    = count($chars);
        $linesCount    = $this->styles->get('font.lines');
        $colorsCount   = $this->styles->get('font.colors');
        $colors        = $this->styles->get('colors');
        $letterSpacing = $this->styles->get('font-letter-spacing') ?? 1;

        for ($i=0; $i < $colorsCount; $i++) { 
            $colorsTags[] = '~\<c'. ($i + 1) . '\>(.*?)\</c'. ($i + 1) . '\>~s';
        }
        for ($i=0; $i < $colorsCount; $i++) { 
            if (isset($colors[$i])) {
                $colorsValues[] = "[color={$colors[($i)]}]$1[/color]";  
            } else {
                $colorsValues[] = "$1";
            }
        }

        for ($j=0; $j < $linesCount; $j++) { 
            for ($i=0; $i < $charsCount; $i++) {

                if ($i == 0) {
                    $result .= preg_replace($colorsTags, $colorsValues, $this->styles->get('font.buffer.' . $j));
                }

                $result .=  preg_replace($colorsTags, $colorsValues, $chars[$i][$j]) . 
                            strings(preg_replace($colorsTags, $colorsValues, $this->styles->get('font.letterspace.' . $j)))->repeat(($letterSpacing > 1) ? $letterSpacing : 1);
                
                if ($i == $charsCount - 1) {
                    $result .= preg_replace($colorsTags, $colorsValues, $this->styles->get('font.buffer.' . $j));
                }
            }
            if ($j + 1 < $linesCount) {
                $result .= PHP_EOL; 
            }
        }
    
        return $result;
    }

    /**
     * Set element value overflow.
     *
     * @param string $value Variant of value overflow.
     * 
     * @return self Returns instance of the Element class.
     *
     * @access public
     */
    public function textOverflow(string $value): self
    {
        $this->styles->set('text-overflow', $value);

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
        if (strings($method)->startsWith('b')) {
            if (strings($method)->startsWith('bg')) {
                return $this->bg(strings($method)->substr(2)->kebab()->toString());
            }

            if (strings($method)->startsWith('borderColor')) {
                return $this->borderColor(strings($method)->substr(11)->kebab()->toString());
            }

            if (strings($method)->substr(6)->toString()) {
                return $this->border(strings($method)->substr(6)->kebab()->toString());
            }
        }

        if (strings($method)->startsWith('color')) {
            if (strings($method)->startsWith('colors')) {
                return $this->colors(...strings($method)->substr(6)->kebab()->segments('-')); 
            }
            return $this->color(strings($method)->substr(5)->kebab()->toString());
        }

        if (strings($method)->startsWith('font')) {
            if (strings($method)->startsWith('fontLetterSpacing')) {
                return $this->fontLetterSpacing(strings($method)->substr(17)->toInteger());
            }
            return $this->font(strings($method)->substr(4)->kebab()->toString());
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

            if (strings($method)->startsWith('mt')) {
                return $this->mt(strings($method)->substr(2)->toInteger());
            }

            if (strings($method)->startsWith('mb')) {
                return $this->mb(strings($method)->substr(2)->toInteger());
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

            if (strings($method)->startsWith('py')) {
                return $this->py(strings($method)->substr(2)->toInteger());
            }

            if (strings($method)->startsWith('pl')) {
                return $this->pl(strings($method)->substr(2)->toInteger());
            }

            if (strings($method)->startsWith('pr')) {
                return $this->pr(strings($method)->substr(2)->toInteger());
            }

            if (strings($method)->startsWith('pt')) {
                return $this->pt(strings($method)->substr(2)->toInteger());
            }

            if (strings($method)->startsWith('pb')) {
                return $this->pb(strings($method)->substr(2)->toInteger());
            }

            if (strings($method)->substr(1)->toInteger()) {
                return $this->p(strings($method)->substr(1)->toInteger());
            }

            return $this->p(...$parameters);
        }

        if (strings($method)->startsWith('d')) {
            return $this->d(strings($method)->substr(1)->kebab()->toString());
        }

        if (strings($method)->startsWith('textAlign')) {
            if (strings($method)->startsWith('textAlignVertical')) {
                return $this->textAlignVertical(strings($method)->substr(17)->kebab()->toString());
            }

            return $this->textAlign(strings($method)->substr(9)->kebab()->toString());
        }

        if (strings($method)->startsWith('textOverflow')) {
            return $this->textOverflow(strings($method)->substr(12)->kebab()->toString());
        }

        if (strings($method)->startsWith('w')) {
            if ($method === 'wAuto') {
                return $this->w('auto');
            }

            return $this->w(strings($method)->substr(1)->toInteger());
        }

        if (strings($method)->startsWith('h')) {
            return $this->h(strings($method)->substr(1)->toInteger());
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
        // Thermage box model and styles hierarchy.
        //
        // ┌─────────────────────────────────────────────────────────────┐
        // │ display                                                     │
        // │ ┌─────────────────────────────────────────────────────────┐ │
        // │ │ outer: margins                                          | │
        // │ │ ┌─────────────────────────────────────────────────────┐ │ │
        // | | | borders                                             | │ │
        // │ │ | ┌─────────────────────────────────────────────────┐ │ │ │
        // │ │ │ │ bg, color                                       │ │ │ │
        // │ │ │ │ ┌─────────────────────────────────────────────┐ │ │ │ │
        // │ │ │ │ │ inner: width, height, paddings              │ │ │ │ │
        // │ │ │ │ │ ┌─────────────────────────────────────────┐ │ │ │ │ │
        // │ │ │ │ │ │ invisible, reverse, blink, dim, bold,   │ │ │ │ │ │
        // │ │ │ │ │ │ italic, underline, strikethrough.       │ │ │ │ │ │
        // | | | | | └─────────────────────────────────────────┘ │ │ │ │ │
        // │ │ │ │ └─────────────────────────────────────────────┘ │ │ │ │
        // │ │ │ └─────────────────────────────────────────────────┘ │ │ │
        // | | └─────────────────────────────────────────────────────┘ │ │
        // │ └─────────────────────────────────────────────────────────┘ │
        // └─────────────────────────────────────────────────────────────┘
        $stylesHierarchy = ['invisible', 'reverse', 'blink', 'dim', 'bold', 'italic', 'underline', 'strikethrough', 'inner', 'bg', 'color', 'outer', 'display'];

        // Get element styles
        $valueLength            = $this->getLength($this->value);
        $textAlignStyle         = $this->styles->get('text-align') ?? 'left';
        $textAlignVerticalStyle = $this->styles->get('text-align-vertical') ?? 'middle';
        $widthStyle             = $this->styles->get('width') ?? 'auto';
        $heightStyle            = $this->styles->get('height') ?? 'auto';
        $displayStyle           = $this->styles->get('display') ?? 'block';
        $borderStyle            = $this->styles->get('border') ?? 'none';
        $textOverflowStyle      = $this->styles->get('text-overflow') ?? 'clip';
        $pl                     = $this->styles->get('padding.left') ?? 0;
        $pr                     = $this->styles->get('padding.right') ?? 0;
        $pt                     = $this->styles->get('padding.top') ?? 0;
        $pb                     = $this->styles->get('padding.bottom') ?? 0;
        $ml                     = $this->styles->get('margin.left') ?? 0;
        $mr                     = $this->styles->get('margin.right') ?? 0;
        $mt                     = $this->styles->get('margin.top') ?? 0;
        $mb                     = $this->styles->get('margin.bottom') ?? 0;
        $spaces                 = 0;
        $borderSpaces           = 2;

        // Helper function for determine is border exist.
        $hasBorder = static function () use ($borderStyle) {
            return $borderStyle !== 'none' && self::$theme->getVariables()->has('borders.' . $borderStyle);
        };

        // Redefine value length if clearfix is true. 
        if ($this->clearfix) {
            $valueLength = ($widthStyle == 'auto' ? Terminal::getWidth() : $valueLength);
        }

        // Apply font style for block element only.
        if ($displayStyle == 'block') {
            $this->value = $this->applyFont($this->value);
        } else {
            $this->styles->delete('font');
        }
    
        // Redefine value and value length if original value length is higher then width style or terminal width.
        if ($widthStyle !== 'auto' && $valueLength > $widthStyle) {
            if ($textOverflowStyle == 'hidden')  {
                $this->value = strings($this->value)->limit($widthStyle - $pr - $pl - ($hasBorder() ? $borderSpaces : 0), '')->toString();
            } elseif($textOverflowStyle == 'ellipsis') {
                $this->value = strings($this->value)->limit($widthStyle - 3 - $pr - $pl - ($hasBorder() ? $borderSpaces : 0))->toString();
            }
            $valueLength = $this->getLength($this->value);
        } elseif ($widthStyle == 'auto' && $valueLength > Terminal::getWidth()) {
            if ($textOverflowStyle == 'hidden')  {
                $this->value = strings($this->value)->limit(Terminal::getWidth() - $ml - $mr - $pr - $pl - ($hasBorder() ? $borderSpaces : 0), '')->toString();
            } elseif($textOverflowStyle == 'ellipsis') {
                $this->value = strings($this->value)->limit(Terminal::getWidth() - 3 - $ml - $mr - $pr - $pl - ($hasBorder() ? $borderSpaces : 0))->toString();
            }
            $valueLength = $this->getLength($this->value);
        }

        // Process style: outer
        $outer = function ($value) use ($ml, $mr, $mt, $mb, $pl, $pr) {

            // Do not allow margins for block elements with clearfix flag.
            if ($this->clearfix) {
                return $value;
            }

            // Do not allow vertical margins and for inline (inline-block) elements,
            // and set negative horizontal paddings for inline (inline-block) elements, do not affect outer styles. 
            if ($this->styles->get('display') === 'inline' || $this->styles->get('display') === 'inline-block') {
                $mt = 0;
                $mb = 0;
                $pl = -1;
                $pr = -1;
            }

            return // Set margin top
                    ($mt > 0 ? strings(PHP_EOL)->repeat($mt) : '') .

                    // Set margin left, only if padding left is not set.
                    ($ml > 0 && $pl < 0 ? strings(' ')->repeat($ml) : '') .

                    // Set Value
                    $value .

                    // Set margin right, only if padding right is not set.
                    ($mr > 0 && $pr < 0 ? strings(' ')->repeat($mr) : '') .

                    // Set margin bottom
                    ($mb > 0 ? strings(PHP_EOL)->repeat($mb) : '');
        };

        // Process style: inner
        $inner = function ($value) use ($valueLength, $textAlignStyle, $textAlignVerticalStyle, $widthStyle, $heightStyle, $displayStyle, $borderStyle, $pl, $pr, $pt, $pb, $ml, $mr, $spaces, $borderSpaces, $hasBorder, $textOverflowStyle) {

            // Calculate element height
            if ($heightStyle !== 'auto' && $heightStyle > 0) {
                if ($textAlignVerticalStyle == 'middle') {
                    $pt = $pt + intval($heightStyle / 2);
                    $pb = $pb + intval($heightStyle / 2);
                }

                if ($textAlignVerticalStyle == 'top') {
                    $pb = $pb + intval($heightStyle) - ($heightStyle % 2 === 0 ? 0 : 1);
                }

                if ($textAlignVerticalStyle == 'bottom') {
                    $pt = $pt + intval($heightStyle) - ($heightStyle % 2 === 0 ? 0 : 1);
                }
            }
            
            // Helper function for re-apply text and background colors.
            $applyTextAndBackgroundColor = function ($value) {
                $bg    = $this->styles->get('bg') ? self::$theme->getVariables()->get('colors.' . $this->styles->get('bg'), $this->styles->get('bg')) : false;
                $color = $this->styles->get('color') ? self::$theme->getVariables()->get('colors.' . $this->styles->get('color'), $this->styles->get('color')) : false;

                $value = ($color ? Color::applyForegroundColor($value, $color) : $value);
                $value = ($bg ? Color::applyBackgroundColor($value, $bg) : $value);

                return $value;
            };

            // Helper function for apply border color.
            $applyBorderColor = function ($value) {
                $color = $this->styles->get('border-color') ? self::$theme->getVariables()->get('colors.' . $this->styles->get('border-color'), $this->styles->get('border-color')) : false;

                $value = ($color ? Color::applyForegroundColor($value, $color) : $value);

                return $value;
            };

            // Helper function for adding paddings and borders, top and bottom
            $addPaddingsAndBordersY = static function ($valueSpaces) use ($borderStyle, $hasBorder, $applyBorderColor, $applyTextAndBackgroundColor, $pt, $pb, $ml) {
                
                // Create box border top value.
                $btStyleValue = '';
                if ($hasBorder()) {
                    $btStyleValue = Styles::resetAll() .
                                    strings(' ')->repeat($ml) .
                                    $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.top-left')) .
                                    $applyBorderColor((string) strings(self::$theme->getVariables()->get('borders.' . $borderStyle . '.top'))->repeat($valueSpaces)) .
                                    $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.top-right')) .
                                    Styles::resetAll() .
                                    PHP_EOL;
                }

                // Create box border bottom value.
                $bbStyleValue = PHP_EOL;
                if ($hasBorder()) {
                    $bbStyleValue = Styles::resetAll() .
                                    strings(' ')->repeat($ml) .
                                    $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.bottom-left')) .
                                    $applyBorderColor((string) strings(self::$theme->getVariables()->get('borders.' . $borderStyle . '.bottom'))->repeat($valueSpaces)) .
                                    $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.bottom-right')) .
                                    Styles::resetAll();
                }

                // Create box padding top value.
                $ptStyleValue = '';
                for ($i = 0; $i < $pt; $i++) {
                    $ptStyleValue .= Styles::resetAll() .
                                     strings(' ')->repeat($ml) .
                                     ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.left')) : '') .
                                     $applyTextAndBackgroundColor((string) strings(' ')->repeat($valueSpaces)) .
                                     ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.right')) : '') .
                                     Styles::resetAll() .
                                     PHP_EOL;
                }

                // Create box padding bottom value.
                $pbStyleValue = PHP_EOL;
                for ($i = 0; $i < $pb; $i++) {
                    $pbStyleValue .= Styles::resetAll() .
                                    strings(' ')->repeat($ml) .
                                    ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.left')) : '') .
                                    $applyTextAndBackgroundColor((string) strings(' ')->repeat($valueSpaces)) .
                                    ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.right')) : '') .
                                    Styles::resetAll() .
                                    PHP_EOL;
                }

                return ['bt' => $btStyleValue, 'bb' => $bbStyleValue, 'pt' => $ptStyleValue, 'pb' => $pbStyleValue];
            };

            if ($displayStyle === 'inline-block' && $widthStyle == 'auto') {
                $widthStyle = $valueLength;
            }
            
            // Set block element with auto width
            if ($widthStyle === 'auto' && $displayStyle === 'block') {
                
                // Do not allow width for block elements with clearfix flag.
                if ($this->clearfix) {
                    return $value;
                }

                // Calculate amount of available spaces for block element.
                $spaces = Terminal::getWidth() - $valueLength;

                // Text align left
                if ($textAlignStyle === 'left') {
                    $paddingsAndBordersY = $addPaddingsAndBordersY($spaces + $valueLength - $mr - $ml - ($hasBorder() ? $borderSpaces : 0));
            
                    if ($textOverflowStyle == 'ellipsis' || $textOverflowStyle == 'hidden')  {
                        $lines = [$this->value];
                    } else {
                        if ($this->styles->has('font')) {
                            $lines = explode(PHP_EOL, $this->value);
                        } else {
                            $lines = explode(PHP_EOL, strings(wordwrap($this->value, Terminal::getWidth() - $pr - $pl - $mr - $ml - ($hasBorder() ? $borderSpaces : 0) + $this->getShortcodesStringSize($this->value), PHP_EOL, false))->trimRight(PHP_EOL)->toString());
                        }
                    }

                    $linesValue = '';
                    foreach ($lines as $key => $line) {
                        // Set box margin left,
                        // paddings left and right,
                        // re-apply text and background colors,
                        // apply borders.
                        $pr = Terminal::getWidth() - $this->getLength($line) - $pl - $ml - $mr - ($hasBorder() ? $borderSpaces : 0);
                        
                        if ($pr < 0) {
                            $pr = 0;
                        }

                        $linesValue .=  Styles::resetAll() .
                                        strings(' ')->repeat($ml) .
                                        ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.left')) : '') .
                                        $applyTextAndBackgroundColor(strings(' ')->repeat($pl) .
                                                                    $line .
                                                                    strings(' ')->repeat($pr)) .
                                        ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.right')) : '') .
                                        ($key === array_key_last($lines) ? '' : PHP_EOL);
                    }

                    return // Set box border top style.
                            ($borderStyle !== 'none' ? $paddingsAndBordersY['bt'] : '') .

                            // Set box padding top.
                            ($pt > 0 ? $paddingsAndBordersY['pt'] : '') .

                            $linesValue .

                            // Set box padding bottom.
                            ($pb > 0 ? strings($paddingsAndBordersY['pb'])->trimRight(PHP_EOL) : '') .

                            // Set box border top style.
                            ($hasBorder() ? strings(' ')->repeat($ml) . $paddingsAndBordersY['bb'] : '');
                }

                // Text align right
                if ($textAlignStyle === 'right') {
                    $paddingsAndBordersY = $addPaddingsAndBordersY($spaces + $valueLength - $mr - $ml - ($hasBorder() ? $borderSpaces : 0));
                    
                    if ($textOverflowStyle == 'ellipsis' || $textOverflowStyle == 'hidden')  {
                        $lines = [$this->value];
                    } else {
                        if ($this->styles->has('font')) {
                            $lines = explode(PHP_EOL, $this->value);
                        } else {
                            $lines = explode(PHP_EOL, strings(wordwrap($this->value, Terminal::getWidth() - $pr - $pl - $mr - $ml - ($hasBorder() ? $borderSpaces : 0) + $this->getShortcodesStringSize($this->value), PHP_EOL, false))->trimRight(PHP_EOL)->toString());
                        }
                    }

                    $linesValue = '';
                    foreach ($lines as $key => $line) {
                        // Set box margin left,
                        // paddings left and right,
                        // re-apply text and background colors,
                        // apply borders.

                        $pl = Terminal::getWidth() - $this->getLength($line) - $pr - $ml - $mr - ($hasBorder() ? $borderSpaces : 0);

                        if ($pl < 0) {
                            $pl = 0;
                        }

                        $linesValue .=  Styles::resetAll() .
                                        strings(' ')->repeat($ml) .
                                        ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.left')) : '') .
                                        $applyTextAndBackgroundColor(strings(' ')->repeat($pl) .
                                                                    $line .
                                                                    strings(' ')->repeat($pr)) .
                                        ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.right')) : '') .
                                        ($key === array_key_last($lines) ? '' : PHP_EOL);
                    }

                    return // Set box border top style.
                            ($borderStyle !== 'none' ? $paddingsAndBordersY['bt'] : '') .

                            // Set box padding top.
                            ($pt > 0 ? $paddingsAndBordersY['pt'] : '') .

                            $linesValue .

                            // Set box padding bottom.
                            ($pb > 0 ? strings($paddingsAndBordersY['pb'])->trimRight(PHP_EOL) : '') .

                            // Set box border top style.
                            ($hasBorder() ? strings(' ')->repeat($ml) . $paddingsAndBordersY['bb'] : '');
                }

                // Text align center
                if ($textAlignStyle === 'center') {
                    $paddingsAndBordersY = $addPaddingsAndBordersY($spaces + $valueLength - $mr - $ml - ($hasBorder() ? $borderSpaces : 0));
                
                    if ($textOverflowStyle == 'ellipsis' || $textOverflowStyle == 'hidden')  {
                        $lines = [$this->value];
                    } else {
                        if ($this->styles->has('font')) {
                            $lines = explode(PHP_EOL, $this->value);
                        } else {
                            $lines = explode(PHP_EOL, strings(wordwrap($this->value, Terminal::getWidth() - $pr - $pl - $mr - $ml - ($hasBorder() ? $borderSpaces : 0) + $this->getShortcodesStringSize($this->value), PHP_EOL, false))->trimRight(PHP_EOL)->toString());
                        }
                    }

                    $linesValue = '';
                    foreach ($lines as $key => $line) {
                        // Get spaces for each line of text.
                        $spaces = Terminal::getWidth() - $this->getLength($line) - $pr - $pl - $mr - $ml - ($hasBorder() ? $borderSpaces : 0);

                        // Calculate left spaces for current box.
                        $currentLeftSpaces  = intval($spaces / 2);
                        $currentRightSpaces = intval($spaces / 2);

                        // Normalize left spaces for current box.
                        if (intval($currentLeftSpaces * 2) < $spaces) {
                            $currentLeftSpaces++;
                        }

                        $currentLine = strings(' ')->repeat((($currentLeftSpaces + $pl) < 0) ? 0 : $currentLeftSpaces + $pl) .
                                      $line .
                                      strings(' ')->repeat((($currentRightSpaces + $pr) < 0) ? 0 : $currentRightSpaces + $pr);
                                      
                        // Set box margin left,
                        // paddings left and right,
                        // re-apply text and background colors,
                        // apply borders.
                        $linesValue .= Styles::resetAll() .
                                        strings(' ')->repeat($ml) .
                                        ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.left')) : '') .
                                        $applyTextAndBackgroundColor($currentLine) .
                                        ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.right')) : '') .
                                        ($key === array_key_last($lines) ? '' : PHP_EOL);
                    }

                    return // Set box border top style.
                            ($borderStyle !== 'none' ? $paddingsAndBordersY['bt'] : '') .

                            // Set box padding top.
                            ($pt > 0 ? $paddingsAndBordersY['pt'] : '') .

                            $linesValue . 
                            
                            // Set box padding bottom.
                            ($pb > 0 ? strings($paddingsAndBordersY['pb'])->trimRight(PHP_EOL) : '') .

                            // Set box border top style.
                            ($hasBorder() ? strings(' ')->repeat($ml) . $paddingsAndBordersY['bb'] : '');
                }
            }

            // Display block with custom width
            if ($widthStyle !== 'auto' && $displayStyle === 'block' || $displayStyle === 'inline-block') {

                // Do not allow to use padding (top, bottom) for inline-block element. 
                if ($displayStyle === 'inline-block') {
                    $pt = 0;
                    $pb = 0;
                }

                $spaces = $widthStyle - $valueLength; 

                // Text align left
                if ($textAlignStyle === 'left') {
                    $paddingsAndBordersY = $addPaddingsAndBordersY($spaces + $valueLength + $pl + $pr - ($hasBorder() ? $borderSpaces : 0));
                
                    if ($textOverflowStyle == 'ellipsis' || $textOverflowStyle == 'hidden')  {
                        $lines = [$this->value];
                    } else {
                        if ($this->styles->has('font')) {
                            $lines = explode(PHP_EOL, $this->value);
                        } else {
                            $lines = explode(PHP_EOL, strings(wordwrap($this->value, $widthStyle - $pr - $pl - ($hasBorder() ? $borderSpaces : 0) + $this->getShortcodesStringSize($this->value), PHP_EOL, false))->trimRight(PHP_EOL)->toString());
                        }
                    }

                    $linesValue = '';
                    foreach ($lines as $key => $line) {

                        // Fix right padding if it is < 0
                        $prCurrent = $pr + $widthStyle - $this->getLength($line) - ($hasBorder() ? $borderSpaces : 0);
                        if ($prCurrent < 0) {
                            $prCurrent = 0;
                        }
                        
                        // Set box margin left,
                        // paddings left and right,
                        // re-apply text and background colors,
                        // apply borders.
                        $linesValue .=  Styles::resetAll() .
                                        strings(' ')->repeat($ml) .
                                        ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.left')) : '') .
                                        $applyTextAndBackgroundColor(strings(' ')->repeat($pl) .
                                                                    $line .
                                                                    strings(' ')->repeat($prCurrent)) .
                                        ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.right')) : '') .
                                        strings(' ')->repeat($mr) .
                                        ($key === array_key_last($lines) ? '' : PHP_EOL);
                    }

                    return // Set box border top style.
                            ($borderStyle !== 'none' ? $paddingsAndBordersY['bt'] : '') .

                            // Set box padding top.
                            ($pt > 0 ? $paddingsAndBordersY['pt'] : '') .

                            $linesValue .

                            // Set box padding bottom.
                            ($pb > 0 ? strings($paddingsAndBordersY['pb'])->trimRight(PHP_EOL) : '') .

                            // Set box border top style.
                            ($hasBorder() ? strings(' ')->repeat($ml) . PHP_EOL . $paddingsAndBordersY['bb'] : '');
                }

                // Text align right
                if ($textAlignStyle === 'right') {

                    $paddingsAndBordersY = $addPaddingsAndBordersY($spaces + $valueLength + $pl + $pr - ($hasBorder() ? $borderSpaces : 0));

                    if ($textOverflowStyle == 'ellipsis' || $textOverflowStyle == 'hidden')  {
                        $lines = [$this->value];
                    } else {
                        if ($this->styles->has('font')) {
                            $lines = explode(PHP_EOL, $this->value);
                        } else {
                            $lines = explode(PHP_EOL, strings(wordwrap($this->value, $widthStyle - $pr - $pl - ($hasBorder() ? $borderSpaces : 0) + $this->getShortcodesStringSize($this->value), PHP_EOL, false))->trimRight(PHP_EOL)->toString());
                        }
                    }
            
                    $linesValue = '';
                    foreach ($lines as $key => $line) {

                        // Fix left padding if it is < 0
                        $plCurrent = $pl + $widthStyle - $this->getLength($line) - ($hasBorder() ? $borderSpaces : 0);
                        if ($plCurrent < 0) {
                            $plCurrent = 0;
                        }

                        // Set box margin left,
                        // paddings left and right,
                        // re-apply text and background colors,
                        // apply borders.
                        $linesValue .=  Styles::resetAll() .
                                        strings(' ')->repeat($ml) .
                                        ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.left')) : '') .
                                        $applyTextAndBackgroundColor(strings(' ')->repeat($plCurrent) .
                                                                    $line .
                                                                    strings(' ')->repeat($pr)) .
                                        ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.right')) : '') .
                                        strings(' ')->repeat($mr) .
                                        ($key === array_key_last($lines) ? '' : PHP_EOL);
                    }

                    return // Set box border top style.
                            ($borderStyle !== 'none' ? $paddingsAndBordersY['bt'] : '') .

                            // Set box padding top.
                            ($pt > 0 ? $paddingsAndBordersY['pt'] : '') .

                            $linesValue .

                            // Set box padding bottom.
                            ($pb > 0 ? strings($paddingsAndBordersY['pb'])->trimRight(PHP_EOL) : '') .

                            // Set box border top style.
                            ($hasBorder() ? strings(' ')->repeat($ml) . PHP_EOL . $paddingsAndBordersY['bb'] : '');
                }

                // Text align center
                if ($textAlignStyle === 'center') {
                
                    if ($textOverflowStyle == 'ellipsis' || $textOverflowStyle == 'hidden')  {
                        $lines = [$this->value];
                    } else {
                        if ($this->styles->has('font')) {
                            $lines = explode(PHP_EOL, $this->value);
                        } else {
                            $lines = explode(PHP_EOL, strings(wordwrap($this->value, $widthStyle - $pr - $pl - ($hasBorder() ? $borderSpaces : 0) + $this->getShortcodesStringSize($this->value), PHP_EOL, false))->trimRight(PHP_EOL)->toString());
                        }
                    }

                    foreach ($lines as $line) {
                        $linesLength[] = $this->getLength($line);
                    }

                    $max = $widthStyle + $pl + $pr - ($hasBorder() ? $borderSpaces : 0);
                    
                    $paddingsAndBordersY = $addPaddingsAndBordersY($max);
                        
                    $linesValue = '';
                    foreach ($lines as $key => $line) {

                        // Get spaces for each line of text.
                        $currentSpaces = $widthStyle - $this->getLength($line) - ($hasBorder() ? $borderSpaces : 0);
                        
                        if ($currentSpaces < 0) {
                            $currentSpaces = 0;
                        }

                        // Calculate left and right spaces for current box.
                        $currentLeftSpaces  = intval($currentSpaces / 2);
                        $currentRightSpaces = intval($currentSpaces / 2);

                        $currentLine = strings(' ')->repeat($currentLeftSpaces + $pl) .
                                      $line .
                                      strings(' ')->repeat($currentRightSpaces + $pr);
                                      
                        if (!$this->styles->has('font')) {
                            
                            // Fix string length it is fit or not fit available printable area
                            if ($this->getLength($currentLine) < $max) {
                                $currentLine .= strings(' ')->repeat($max - $this->getLength($currentLine))->toString();
                            } else if ($this->getLength($currentLine) > $max) {
                                $currentLine = mb_substr($currentLine, 0, - ($this->getLength($currentLine) - $max));
                            }
                        }

                        // Set box margin left,
                        // paddings left and right,
                        // re-apply text and background colors,
                        // apply borders.
                        $linesValue .=  Styles::resetAll() .
                                        strings(' ')->repeat($ml) .
                                        ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.left')) : '') .
                                        $applyTextAndBackgroundColor($currentLine) .
                                        ($hasBorder() ? $applyBorderColor(self::$theme->getVariables()->get('borders.' . $borderStyle . '.right')) : '') .
                                        strings(' ')->repeat($mr) .
                                        ($key === array_key_last($lines) ? '' : PHP_EOL);
                    }

                    return // Set box border top style.
                            ($borderStyle !== 'none' ? $paddingsAndBordersY['bt'] : '') .

                            // Set box padding top.
                            ($pt > 0 ? $paddingsAndBordersY['pt'] : '') .

                            $linesValue .
                            
                            // Set box padding bottom.
                            ($pb > 0 ? strings($paddingsAndBordersY['pb'])->trimRight(PHP_EOL) : '') .

                            // Set box border top style.
                            ($hasBorder() ? strings(' ')->repeat($ml) . PHP_EOL . $paddingsAndBordersY['bb'] : '');
                }
            }

            // Display inline
            if ($displayStyle === 'inline') {
                return strings(' ')->repeat($pl) . $value . strings(' ')->repeat($pr);
            }
        };

        // Process style: color
        $color = function ($value) {
            $color = $this->styles->get('color') ? self::$theme->getVariables()->get('colors.' . $this->styles->get('color'), $this->styles->get('color')) : false;

            return $color ? Color::applyForegroundColor($value, $color) : $value;
        };

        // Process style: bg
        $bg = function ($value) {
            $bg = $this->styles->get('bg') ? self::$theme->getVariables()->get('colors.' . $this->styles->get('bg'), $this->styles->get('bg')) : false;

            return $bg ? Color::applyBackgroundColor($value, $bg) : $value;
        };

        // Process style: bold
        $bold = function ($value) {
            return $this->styles['bold'] ? Styles::setBold() . $value . Styles::resetBold() : $value;
        };

        // Process style: italic
        $italic = function ($value) {
            return $this->styles['italic'] ? Styles::setItalic() . $value . Styles::resetItalic() : $value;
        };

        // Process style: underline
        $underline = function ($value) {
            return $this->styles['underline'] ? Styles::setUnderline() . $value . Styles::resetUnderline() : $value;
        };

        // Process style: strikethrough
        $strikethrough = function ($value) {
            return $this->styles['strikethrough'] ? Styles::setStrikethrough() . $value . Styles::resetStrikethrough() : $value;
        };

        // Process style: dim
        $dim = function ($value) {
            return $this->styles['dim'] ? Styles::setDim() . $value . Styles::resetDim() : $value;
        };

        // Process style: blink
        $blink = function ($value) {
            return $this->styles['blink'] ? Styles::setBlink() . $value . Styles::resetBlink() : $value;
        };

        // Process style: reverse
        $reverse = function ($value) {
            return $this->styles['reverse'] ? Styles::setReverse() . $value . Styles::resetReverse() : $value;
        };

        // Process style: invisible
        $invisible = function ($value) {
            return $this->styles['invisible'] ? Styles::setInvisible() . $value . Styles::resetInvisible() : $value;
        };

        // Process style: display
        $display = function ($value) use ($displayStyle) {
            switch ($displayStyle) {
                case 'inline':
                    return $value;

                    break;
                case 'inline-block':
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
        return preg_replace("/" . getEsc() . "\[[^m]*m/", '', $value);
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
     * Get shortcodes string size.
     *
     * @param string $value Value.
     *
     * @return int Shortcodes string size.
     *
     * @access public
     */
    private function getShortcodesStringSize(string $value)
    {
        $counter = 0;
        foreach($this->getShortcodes()->parseText($value) as $s) {
            $counter += strings($s->getName())->length() + strings($s->getBbCode())->length();
        }

        return $counter;
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
