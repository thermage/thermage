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

    final public function __construct($renderer = null, $value = '', $properties = [])
    {
        $this->renderer   = $renderer;
        $this->value      = strings($value);
        $this->properties = arrays($properties);
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getRenderer()
    {
        return $this->renderer;
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function value($value)
    {
        $this->value = strings($value);

        return $this;
    }

    public function properties(array $properties)
    {
        $this->properties = arrays($properties);

        return $this;
    }

    public function color($color)
    {
        $this->properties->set('color', $color);

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

    public function mx(int $value)
    {
        $this->properties->set('margin.left', $value / 2);
        $this->properties->set('margin.right', $value / 2);

        return $this;
    }

    public function ml(int $value)
    {
        $this->properties->set('margin.left', $value);

        return $this;
    }

    public function mr(int $value)
    {
        $this->properties->set('margin.right', $value);

        return $this;
    }

    public function px(int $value)
    {
        $this->properties->set('padding.left', $value / 2);
        $this->properties->set('padding.right', $value / 2);

        return $this;
    }

    public function pl(int $value)
    {
        $this->properties->set('padding.left', $value);

        return $this;
    }

    public function pr(int $value)
    {
        $this->properties->set('padding.right', $value);

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
     * Render element.
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
