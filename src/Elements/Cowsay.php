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

namespace Thermage\Elements;

use Thermage\Base\Element;
use Glowy\Arrays\Arrays as Collection;
use Exception;

use function arrays as collection;
use function Thermage\terminal;
use function Thermage\div;

final class Cowsay extends Element
{
    /**
     * Cowsay thoughts.
     *
     * @access private
     */
    private string $thoughts;

    /**
     * Cowsay template.
     *
     * @access private
     */
    private string $template;

    /**
     * Cowsay eyes.
     *
     * @access private
     */
    private string $eyes;

    /**
     * Cowsay eye left.
     *
     * @access private
     */
    private string $eyeLeft;

    /**
     * Cowsay eye right.
     *
     * @access private
     */
    private string $eyeRight;

    /**
     * Cowsay tongue.
     *
     * @access private
     */
    private string $tongue;

    /**
     * Cowsay template.
     *
     * @access private
     */
    private bool $think = false;

    /**
     * Cowsay thoughts.
     * 
     * @param sting $value Thoughts symbol.
     * 
     * @return self Returns instance of the Cowsay class.
     *
     * @access public
     */
    public function thoughts(string $value): self
    {
        $this->thoughts = $value;

        return $this;
    }

    /**
     * Cowsay template.
     * 
     * @param sting $value Template name.
     * 
     * @return self Returns instance of the Cowsay class.
     *
     * @access public
     */
    public function template(string $value): self
    {
        $this->template = $value;
        
        return $this;
    }

    /**
     * Cowsay eyes.
     * 
     * @param sting $value Eyes symbol.
     * 
     * @return self Returns instance of the Cowsay class.
     *
     * @access public
     */
    public function eyes(string $value): self
    {
        $this->eyes = $value;

        return $this;
    }

    /**
     * Cowsay eye left.
     * 
     * @param sting $value Eye left symbol.
     * 
     * @return self Returns instance of the Cowsay class.
     *
     * @access public
     */
    public function eyeLeft(string $value): self
    {
        $this->eyeLeft = $value;

        return $this;
    }

    /**
     * Cowsay eye right.
     * 
     * @param sting $value Eye right symbol.
     * 
     * @return self Returns instance of the Cowsay class.
     *
     * @access public
     */
    public function eyeRight(string $value): self
    {
        $this->eyeRight = $value;

        return $this;
    }

    /**
     * Set cowsay think state.
     * 
     * @return self Returns instance of the Cowsay class.
     *
     * @access public
     */
    public function think(): self
    {
        $this->think = true;

        return $this;
    }

    /**
     * Set cowsay face mode.
     * 
     * @param sting $value Cowsay face mode. One of "b", "d", "g", "p", "s", "t", "w", "y".
     * 
     * @return self Returns instance of the Cowsay class.
     *
     * @access public
     */
    public function mode(string $value): self
    {
        $modes = ['b', 'd', 'g', 'p', 's', 't', 'w', 'y'];

        if (in_array($value, $modes)) {
            switch ($value) {
                // borg
                case 'b':
                    $this->eyes = "==";
                    $this->tongue = "  ";
                    break;
                // dead
                case 'd':
                    $this->eyes = "xx";
                    $this->tongue = "U ";
                // greedy
                case 'g':
                    $this->eyes = "$$";
                    $this->tongue = "  ";
                // paranoia
                case 'p':
                    $this->eyes = "@@";
                    $this->tongue = "  ";
                // stoned
                case 's':
                    $this->eyes = "**";
                    $this->tongue = "U ";
                // tired
                case 't':
                    $this->eyes = "--";
                    $this->tongue = "  ";
                // wired
                case 'w':
                    $this->eyes = "OO";
                    $this->tongue = "  ";
                // wired
                case 'y':
                    $this->eyes = "..";
                    $this->tongue = "  ";
                    break;
                // youthful
                default:
                    break;
            }
        }

        return $this;
    }

    /**
     * Cowsay tongue.
     * 
     * @param sting $value Cowsay tongue symbol.
     * 
     * @return self Returns instance of the Cowsay class.
     *
     * @access public
     */
    public function tongue(string $value): self 
    {
        $this->tongue = $value;

        return $this;
    }

    /**
     * Get Cowsay element variables.
     *
     * @return Collection Cowsay element variables.
     *
     * @access public
     */
    public function getElementVariables(): Collection
    {
        return collection([
            'cowsay' => [
                'thoughts' => '\\', // Thoughts symbol.
                'template' => '',   // Template for a cow, get inspiration from `./cows`.
                'eyes' => 'oo',     // Select the appearance of the cow's eyes.
                'eye-left' => 'o',  // Select the appearance of the cow's eye left.
                'eye-right' => 'o', // Select the appearance of the cow's eye right.
                'tongue' => '',     // The tongue is configurable similarly to the eyes.
                'mode' => 'b',      // One of "b", "d", "g", "p", "s", "t", "w", "y".
                'width' => 50,      // Width
            ],
        ]);
    }

    private function getTemplate(string $template, array $vars): string
    {
        $cowFile = __DIR__ . '/../../cows/' . $template . '.cow';

        if (! file_exists($cowFile)) {
            throw new Exception("Template {$template} not found.");
        }

        extract($vars, EXTR_REFS);
        ob_start();
        include $cowFile;
        return ob_get_clean() ?: '';
    }

    private function getBallon(): string
    {   
        $elementVariables = $this->getElementVariables();
        $theme            = $this->getTheme();

        return div($this->getValue())
                    ->pipe(function($el) {
                        if ($this->think) {
                            $el->borderCowThink();
                        } else {
                            $el->borderCowSay();
                        }
                    })
                    ->w(isset($this->getStyles()['width']) ? $this->getStyles()['width'] : $theme->getVariables()->get('cowsay.width', $elementVariables['cowsay']['width']))
                    ->px1()
                    ->renderToString();
    }

    /**
     * Render Cowsay element.
     *
     * @return string Returns rendered Cowsay element.
     *
     * @access public
     */
    public function renderToString(): string
    {
        $this->d($this->getStyles()->get('display') ?? 'block');
       
        $elementVariables = $this->getElementVariables();
        $theme            = $this->getTheme();

        $thoughts = $this->thoughts ?? $theme->getVariables()->get('cowsay.thoughts', $elementVariables['cowsay']['thoughts']);
        $template = $this->template ?? $theme->getVariables()->get('cowsay.template', $elementVariables['cowsay']['template']);
        $eyes = $this->eyes ?? $theme->getVariables()->get('cowsay.eyes', $elementVariables['cowsay']['eyes']);
        $tongue = $this->tongue ?? $theme->getVariables()->get('cowsay.tongue', $elementVariables['cowsay']['tongue']); 
        $eyeLeft  = isset($this->eyes[0]) ? $this->eyes[0] : $this->eyeLeft ?? $theme->getVariables()->get('cowsay.eye-left', $elementVariables['cowsay']['eye-left']);
        $eyeRight = isset($this->eyes[1]) ? $this->eyes[1] : $this->eyeRight ?? $theme->getVariables()->get('cowsay.eye-right', $elementVariables['cowsay']['eye-right']);
        
        $this->value(
            $this->getBallon() .
            $this->getTemplate($template, ['thoughts' => $thoughts, 'eyes' => $eyes, 'tongue' => $tongue, 'eyeLeft' => $eyeLeft, 'eyeRight' => $eyeRight]) .
            PHP_EOL
        );

        return $this->getValue();
    }
}
