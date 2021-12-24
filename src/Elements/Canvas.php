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

use Glowy\Arrays\Arrays as Collection;
use Thermage\Base\Element;
use function arrays as collection;
use function Thermage\span;

use InvalidArgumentException;

use const PHP_EOL;

final class Canvas extends Element
{
    /**
     * Canvas pixel width.
     *
     * @access private
     */
    private int $pixelWidth;

    /**
     * Canvas width.
     *
     * @access private
     */
    private int $width;

    /**
     * Canvas height.
     *
     * @access private
     */
    private int $height;

    /**
     * Canvas.
     *
     * @access private
     */
    private static ?array $canvas = null;

    /**
     * Set Canvas pixel width.
     * 
     * @param int $value Canvase pixel width.
     * 
     * @access public
     */
    public function pixelWidth(int $value): self
    {
        if ($value < 1) {
            throw new InvalidArgumentException("Canvas pixel width must be greater than zero.");
        }

        $this->getStyles()->set('pixel-width', $value);

        return $this;
    }

    /**
     * Set Canvas size.
     * 
     * @param int    $width  Canvas width.
     * @param int    $height Canvas height.
     * 
     * @access public
     */
    public function size(int $width, int $height): self
    {
        if ($width < 1) {
            throw new InvalidArgumentException("Canvas width must be > 1");
        }

        if ($height < 1) {
            throw new InvalidArgumentException("Canvas height must be > 1");
        }

        $this->getStyles()->set('width', $width);
        $this->getStyles()->set('height', $height);

        return $this;
    }

    /**
     * Set Canvas pixel.
     * 
     * @param int    $x     Canvas pixel position x.
     * @param int    $y     Canvas pixel position y.
     * @param string $color Canvas pixel color.
     * 
     * @access public
     */
    public function pixel(int $x, int $y, string $color): self
    {
        $this->initCanvas();

        self::$canvas[$x][$y] = $color;

        return $this;
    }

    /**
     * Set Canvas pixels.
     * 
     * @param array $pixles Canvas pixels array with colors.
     * 
     * @access public
     */
    public function pixels(array $pixels): self 
    {
        $this->initCanvas();

        self::$canvas = array_replace(self::$canvas, $pixels);

        return $this;
    }

    /**
     * Get Canvas element variables.
     *
     * @return Collection Canvas element variables.
     *
     * @access public
     */
    public function getElementVariables(): Collection
    {
        return collection([
            'canvas' => [
                'width' => 16,
                'height' => 16,
                'pixel-width' => 3,
            ],
        ]);
    }

    /**
     * Render canvas element.
     *
     * @return string Returns rendered canvas element.
     *
     * @access public
     */
    public function render(): string
    {
        $theme            = $this->getTheme();
        $elementVariables = $this->getElementVariables();
        $pixelWidth       = $this->getStyles()['pixel-width'] ?? $theme->getVariables()->get('canvas.pixel-width', $elementVariables['canvas']['pixel-width']);
        $result           = '';
        
        foreach(self::$canvas as $line) {
            foreach ($line as $pixel) {
                $result .= span(strings(' ')->repeat(3)->toString())->bg($pixel);
            }
            $result .= PHP_EOL;
        }

        return $result;
    }

    /**
     * Init canvas.
     * 
     * @access public
     */
    private function initCanvas(): void
    {
        $theme            = $this->getTheme();
        $elementVariables = $this->getElementVariables();
        $canvasWidth      = $this->getStyles()['width'] ?? $theme->getVariables()->get('canvas.width', $elementVariables['canvas']['width']);
        $canvasHeight     = $this->getStyles()['height'] ?? $theme->getVariables()->get('canvas.height', $elementVariables['canvas']['height']);

        if (self::$canvas === null) {
            for ($canvasX=0; $canvasX < $canvasWidth; $canvasX++) { 
                for ($canvasY=0; $canvasY < $canvasHeight; $canvasY++) { 
                    self::$canvas[$canvasX][$canvasY] = '';
                }
            }
        }
    }
}
