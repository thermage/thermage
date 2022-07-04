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
use Exception;
use function Thermage\terminal;
use function Glowy\Strings\strings;

final class Image extends Element
{
    /**
     * Set image src.
     * 
     * @param string $value Image src.
     * 
     * @return self Returns instance of the Image class.
     *
     * @access public
     */
    public function src(string $value): self
    {
        $this->getStyles()->set('src', $value);

        return $this;
    } 

    /**
     * Render Image element.
     *
     * @return string Returns rendered Image element.
     *
     * @access public
     */
    public function renderToString(): string
    {
        $this->d($this->getStyles()->get('display') ?? 'block');

        $src         = $this->getStyles()['src'];
        $fileContent = '';

        if (! strings($src)->isBase64()) {
            if (! file_exists($src)) {
                throw new Exception("Image {$src} not found.");
            }

            $fileContent = file_get_contents($src);

            if (! $fileContent) {
                throw new Exception("Image {$src} not loaded.");
            }
        }

        if (terminal()->isIterm() && version_compare(terminal()->getVersion(), '3.0.0', '>=')) {
            $this->value(
                terminal()->getOsc() . 
                "1337;File=" . 
                ($this->getStyles()['width'] ? "width=" . $this->getStyles()['width'] . ";" : "") . 
                ($this->getStyles()['height'] ? "height=" . $this->getStyles()['height'] . ";" : "") .
                "inline=1:" . 
                base64_encode($fileContent) . 
                terminal()->getEsc() . 
                "\\"
            );
        }

        return parent::renderToString();
    }
}
