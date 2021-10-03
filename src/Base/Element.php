<?php

declare(strict_types=1);

namespace Termage\Base;

use Atomastic\Arrays\Arrays;
use Atomastic\Strings\Strings;
use BadMethodCallException;
use Symfony\Component\Console\Output\OutputInterface;

use function arrays;
use function intval;
use function sprintf;
use function strings;
use function substr;

abstract class Element
{
    /**
     * The implementation of the output.
     *
     * @access private
     */
    private OutputInterface $renderer;

    /**
     * Base element properties.
     *
     * @access private
     */
    private Arrays $properties;

    /**
     * Base element value.
     *
     * @access private
     */
    private Strings $value;

    /**
     * Create base element.
     *
     * @param string $value      Base element value.
     * @param array  $properties Base element properties.
     *
     * @return Element Returns base element component.
     *
     * @access public
     */
    final public function __construct($renderer, $theme, string $value = '', array $properties = [])
    {
        $this->renderer   = $renderer;
        $this->theme      = $theme;
        $this->value      = strings($value);
        $this->properties = arrays($properties);
    }

    /**
     * Get base element value.
     *
     * @return Strings Returns base element value.
     *
     * @access public
     */
    public function getValue(): Strings
    {
        return $this->value;
    }

    /**
     * Get base element renderer.
     *
     * @return OutputInterface Returns base element renderer.
     *
     * @access public
     */
    public function getRenderer(): OutputInterface
    {
        return $this->renderer;
    }

    /**
     * Get base element properties.
     *
     * @return Arrays Returns base element properties.
     *
     * @access public
     */
    public function getProperties(): Arrays
    {
        return $this->properties;
    }

    /**
     * Set base element value.
     *
     * @param string $value Base element value.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function value(string $value = ''): self
    {
        $this->value = strings($value);

        return $this;
    }

    /**
     * Set base element properties.
     *
     * @param string $properties Base element properties.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function properties(array $properties = []): self
    {
        $this->properties = arrays($properties);

        return $this;
    }

    /**
     * Set base element renderer.
     *
     * @param OutputInterface $renderer Base element renderer interface.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function renderer(OutputInterface $renderer): self
    {
        $this->renderer = $renderer;

        return $this;
    }

    /**
     * Set base element color.
     *
     * @param string $color Base element color.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function color(string $color): self
    {
        $this->properties->set('color', $this->theme->variables()->get('colors.' . $color, $color));

        return $this;
    }

    /**
     * Set base element background color.
     *
     * @param string $color Base element background color.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function bg(string $color): self
    {
        $this->properties->set('bg', $this->theme->variables()->get('colors.' . $color, $color));

        return $this;
    }

    /**
     * Set base element bold property.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function bold(): self
    {
        $this->properties->set('options.bold', 'bold');

        return $this;
    }

    /**
     * Set base element underline property, alias to underscore.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function underline(): self
    {
        $this->properties->set('options.underscore', 'underscore');

        return $this;
    }

    /**
     * Set base element underscore property.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function underscore(): self
    {
        $this->properties->set('options.underscore', 'underscore');

        return $this;
    }

    /**
     * Set base element blink property.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function blink(): self
    {
        $this->properties->set('options.blink', 'blink');

        return $this;
    }

    /**
     * Set base element reverse property.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function reverse(): self
    {
        $this->properties->set('options.reverse', 'reverse');

        return $this;
    }

    /**
     * Set base element conceal property.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function conceal(): self
    {
        $this->properties->set('options.conceal', 'conceal');

        return $this;
    }

    /**
     * Set base element margin x property.
     *
     * @param int $value Maring x.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function mx(int $value): self
    {
        $this->properties->set('margin.left', intval($value / 2));
        $this->properties->set('margin.right', intval($value / 2));

        return $this;
    }

    /**
     * Set base element margin left property.
     *
     * @param int $value Maring left.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function ml(int $value): self
    {
        $this->properties->set('margin.left', $value);

        return $this;
    }

    /**
     * Set base element margin right property.
     *
     * @param int $value Maring right.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function mr(int $value): self
    {
        $this->properties->set('margin.right', $value);

        return $this;
    }

    /**
     * Set base element padding x property.
     *
     * @param int $value Padding x.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function px(int $value): self
    {
        $this->properties->set('padding.left', intval($value / 2));
        $this->properties->set('padding.right', intval($value / 2));

        return $this;
    }

    /**
     * Set base element padding left property.
     *
     * @param int $value Padding left.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function pl(int $value): self
    {
        $this->properties->set('padding.left', $value);

        return $this;
    }

    /**
     * Set base element padding right property.
     *
     * @param int $value Padding right.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function pr(int $value): self
    {
        $this->properties->set('padding.right', $value);

        return $this;
    }

    /**
     * Limit the number of characters in the element value.
     *
     * @param  int    $limit  Limit of characters.
     * @param  string $append Text to append to the string IF it gets truncated.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function limit(int $limit = 100, string $append = '...'): self
    {
        $this->value->limit($limit, $append);

        return $this;
    }

    /**
     * Convert element value to lower-case.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function lower(): self
    {
        $this->value->lower();

        return $this;
    }

    /**
     * Convert element value to upper-case.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function upper(): self
    {
        $this->value->upper();

        return $this;
    }

    /**
     * Repeated element value given a multiplier.
     *
     * @param int $multiplier The number of times to repeat the string.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function repeat(int $multiplier): self
    {
        $this->value->repeat($multiplier);

        return $this;
    }

    /**
     * Convert element value to camel case.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function camel(): self
    {
        $this->value->camel();

        return $this;
    }

    /**
     * Convert element value first character of every word of string to upper case and the others to lower case.
     *
     * @return self Returns instance of the BaseElement class.
     *
     * @access public
     */
    public function capitalize(): self
    {
        $this->value->capitalize();

        return $this;
    }

    /**
     * Dynamically bind magic methods to the BaseElement class.
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
     * Render base element.
     *
     * @return string Returns rendered base element.
     *
     * @access public
     */
    public function render(): string
    {
        $fg      = null;
        $bg      = null;
        $options = null;

        if ($this->properties->has('color')) {
            $fg = 'fg=' . $this->properties->get('color') . ';';
        }

        if ($this->properties->has('bg')) {
            $bg = 'bg=' . $this->properties->get('bg') . ';';
        }

        if ($this->properties->has('options')) {
            $options = 'options=' . arrays($this->properties->get('options'))->toString(',') . ';';
        }

        if ($this->properties->has('padding.left')) {
            $this->value->prepend((string) strings(' ')->repeat($this->properties->get('padding.left')));
        }

        if ($this->properties->has('padding.right')) {
            $this->value->append((string) strings(' ')->repeat($this->properties->get('padding.right')));
        }

        if ($fg || $bg || $options) {
            $element = '<' .
                        $fg .
                        $bg .
                        $options .
                        '>' . (string) $this->value . '</>';
        } else {
            $element = (string) $this->value;
        }

        if ($this->properties->has('margin.left')) {
            $element = (string) strings($element)->prepend((string) strings(' ')->repeat($this->properties->get('margin.left')));
        }

        if ($this->properties->has('margin.right')) {
            $element = (string) strings($element)->append((string) strings(' ')->repeat($this->properties->get('margin.right')));
        }

        return $element;
    }

    /**
     * Display base element.
     *
     * @param string $type Display type.
     *
     * @throws BadMethodCallException If method not found.
     *
     * @access public
     */
    public function display(string $type = 'row')
    {
        switch ($type) {
            case 'none':
                $this->renderer->write('');
                break;

            case 'col':
                $this->renderer->write($this->render());
                break;

            case 'row':
            default:
                $this->renderer->writeln($this->render());
                break;
        }
    }

    /**
     * Get base element as string.
     *
     * @return string Returns base element string representation.
     */
    public function __toString(): string
    {
        return $this->render();
    }
}
