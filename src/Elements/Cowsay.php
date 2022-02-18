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

final class Cowsay extends Element
{
    private string $thoughts;
    private string $template;
    private string $eyes;
    private string $eyeLeft;
    private string $eyeRight;
    private string $mode;
    private string $tongue;

    public function thoughts($value) {
        $this->thoughts = $value;

        return $this;
    }

    public function template($value) {
        $this->template = $value;
        
        return $this;
    }

    public function eyes($value) {
        $this->eyes = $value;

        return $this;
    }

    public function eyeLeft($value) {
        $this->eyeLeft = $value;

        return $this;
    }

    public function eyeRight($value) {
        $this->eyeRight = $value;

        return $this;
    }

    public function mode($value) {
        $this->mode = $value;

        return $this;
    }

    public function tongue($value) {
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
            ],
        ]);
    }

    private function getTemplate(string $template, array $vars): string
    {
        $fontFile = __DIR__ . '/../../cows/' . $template . '.cow';

        if (! file_exists($fontFile)) {
            throw new Exception("Template {$template} not found.");
        }

        extract($vars, EXTR_REFS);
        ob_start();
        include $fontFile;
        return ob_get_clean() ?: '';
    }

    private function getBallon(): string
    {
        $result = <<<EOT
          ------------
        < {$this->getValue()} >
          ------------
        EOT;

        return $result;
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
        $eyeLeft = $this->eyeLeft ?? $theme->getVariables()->get('cowsay.eye-left', $elementVariables['cowsay']['eye-left']);
        $eyeRight = $this->eyeRight ?? $theme->getVariables()->get('cowsay.eye-right', $elementVariables['cowsay']['eye-right']);

        $this->value(
            $this->getBallon() .
            $this->getTemplate($template, ['thoughts' => $thoughts, 'eyes' => $eyes, 'tongue' => $tongue, 'eyeLeft' => $eyeLeft, 'eyeRight' => $eyeRight]) .
            PHP_EOL
        );

        return $this->getValue();
    }
}
