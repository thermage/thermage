<?php

declare(strict_types=1);

namespace Clirad;

use Symfony\Component\Console\Output\ConsoleOutput;
use Atomastic\Arrays\Arrays;
use Atomastic\Strings\Strings;

use function arrays;
use function strings;

class Clirad
{
    private $properties;
    private $string;
    private $renderer;

    public function __construct(string $string, array $properties = [], $renderer = null)
    {
        $this->properties = arrays($properties);
        $this->string     = strings($string);
        $this->renderer   = $renderer ?? new ConsoleOutput();
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
        $this->string->prepend(strings(' ')->repeat($value)->toString());
        $this->string->append(strings(' ')->repeat($value)->toString());
        return $this;
    }
    
    public function pl(int $value) 
    {
        $this->string->prepend(strings(' ')->repeat($value)->toString());
        return $this;
    }

    public function pr(int $value) 
    {
        $this->string->append(strings(' ')->repeat($value)->toString());
        return $this;
    }

    public function lower()
    {
        $this->string->lower();
        return $this; 
    }

    /**
     * Render string.
     */
    public function render(): void
    {
        $this->renderer->writeln($this->toString());
    }

    /**
     * Get the string representation.
     */
    public function toString(): string
    {
        if ($this->properties->has('fg')) {
            $fg = 'fg=' . $this->properties->get('fg') . ';';
        }
        
        if ($this->properties->has('bg')) {
            $bg = 'bg=' . $this->properties->get('bg') . ';';
        }

        if ($this->properties->has('options')) {
            $options = 'options=' . arrays($this->properties->get('options'))->toString(',')  . ';';
        }

        $output = '<' . 
                  $fg . 
                  $bg .
                  $options .
                  '>'. $this->string->toString() .'</>';

        return $output;
    }    

    /**
     * Get the string representation.
     *
     * @return string Returns the string representation.
     */
    public function __toString(): string
    {
        return $this->toString();
    }
}
