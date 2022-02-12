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
use function Thermage\span;

final class Spark extends Element
{
    /**
     * Spark data.
     *
     * @access private
     */
    private array $sparkData = [];

    /**
     * Spark ticks.
     *
     * @access private
     */
    private array $sparkTicks = ['▁', '▂', '▃', '▄', '▅', '▆', '▇', '█'];
        
    /**
     * Set spark data.
     *
     * @param array $data Data with numbers.
     *
     * @return self Returns instance of the Spark class.
     *
     * @access public
     */
    public function data(array $data): self
    {
        $this->sparkData = $data;

        return $this;
    }

    /**
     * Render Span element.
     *
     * @return string Returns rendered Span element.
     *
     * @access public
     */
    public function renderToString(): string
    {
        $this->processClasses();
        $this->d($this->getStyles()->get('display') ?? 'block');
        
        $result  = '';
        $min = min($this->sparkData);
        $max = max($this->sparkData);

        // Use a high tick if data is constant and max is not equal to 0.
        if ($min === $max && $max !== 0) {
            $this->sparkTicks = [$this->sparkTicks[4]];
        }
        
        foreach ($this->sparkData as $number) {
            $tickIndex = ceil(($number / $max) * count($this->sparkTicks)) - 1;
            if ($max === 0 || $tickIndex < 0) $tickIndex = 0;
            $result .= span($this->sparkTicks[$tickIndex])->color($this->getStyles()['color'] . (($tickIndex == 0) ? 100 : $tickIndex * 100))->renderToString();
        }

        $this->value($result);

        return parent::renderToString();
    }
}
