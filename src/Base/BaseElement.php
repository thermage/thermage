<?php

declare(strict_types=1);

namespace Clirad\Base;

use function arrays;
use function strings;

abstract class BaseElement
{
    private $properties;
    private $value;
    private $renderer;

    final public function __construct($renderer = null, $value)
    {
        $this->properties = arrays([]);
        $this->value      = strings($value);
        $this->renderer   = $renderer;
    }

    public function value()
    {
        return $this->value;
    }

    public function renderer()
    {
        return $this->renderer;
    }

    public function properties()
    {
        return $this->properties;
    }

    public function color($color)
    {
        $this->properties->set('fg', $color);

        return $this;
    }

    public function bg($color)
    {
        $this->properties->set('bg', $color);

        return $this;
    }

    public function bold()
    {
        $this->properties->set('options.bold', 'bold');

        return $this;
    }

    public function underline()
    {
        $this->properties->set('options.underscore', 'underscore');

        return $this;
    }

    public function blink()
    {
        $this->properties->set('options.blink', 'blink');

        return $this;
    }

    public function reverse()
    {
        $this->properties->set('options.reverse', 'reverse');

        return $this;
    }

    public function conceal()
    {
        $this->properties->set('options.conceal', 'conceal');

        return $this;
    }

    public function px(int $value)
    {
        $this->value->prepend(strings(' ')->repeat($value)->toString());
        $this->value->append(strings(' ')->repeat($value)->toString());

        return $this;
    }

    public function pl(int $value)
    {
        $this->value->prepend(strings(' ')->repeat($value)->toString());

        return $this;
    }

    public function pr(int $value)
    {

        $this->value->append(strings(' ')->repeat($value)->toString());

        return $this;
    }

    public function lower()
    {
        $this->value->lower();

        return $this;
    }

    public function upper()
    {
        $this->value->upper();

        return $this;
    }

    public function camel()
    {
        $this->value->camel();

        return $this;
    }

    public function capitalize()
    {
        $this->value->capitalize();

        return $this;
    }

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
     * Render element.
     */
    public function render(): string
    {
        $fg      = null;
        $bg      = null;
        $options = null;

        if ($this->properties->has('fg')) {
            $fg = 'fg=' . $this->properties->get('fg') . ';';
        }

        if ($this->properties->has('bg')) {
            $bg = 'bg=' . $this->properties->get('bg') . ';';
        }

        if ($this->properties->has('options')) {
            $options = 'options=' . arrays($this->properties->get('options'))->toString(',') . ';';
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

        return $element;
    }

    /**
     * Display element.
     */
    public function display($type = 'row'): void
    {
        switch ($type) {
            case 'none':
                // ... display none
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
     * Get element.
     *
     * @return string Returns the element string representation.
     */
    public function __toString(): string
    {
        return $this->render();
    }
}
