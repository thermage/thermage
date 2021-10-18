<?php

declare(strict_types=1);

/**
 * Termage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/termage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    Sergey Romanenko <sergey.romanenko@flextype.org>
 * @copyright Copyright (c) Sergey Romanenko (https://awilum.github.io)
 * @link      https://digital.flextype.org/termage/ Termage
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace Termage\Elements;

use Termage\Base\Element;

final class Anchor extends Element
{
    /**
     * Set link href property.
     *
     * @param string $value Href value.
     *
     * @return self Returns instance of the Anchor class.
     *
     * @access public
     */
    public function href(string $value): self
    {
        $this->setValue("\e]8;;" . $value . "\e\\" . $this->getValue() . "\e]8;;\e\\");

        return $this;
    }
}