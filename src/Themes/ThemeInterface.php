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

namespace Thermage\Themes;

use Glowy\Arrays\Arrays as Collection;

interface ThemeInterface
{
    /**
     * Get Theme custom variables.
     *
     * @return Collection Collection of Theme custom variables.
     *
     * @access public
     */
    public function getThemeVariables(): Collection;

    /**
     * Get Theme variables.
     *
     * @return Collection Collecton of Theme variables.
     *
     * @access public
     */
    public function getVariables(): Collection;

    /**
     * Set Theme variables.
     *
     * @param array $variables Theme variables.
     *
     * @return self Returns instance of the Theme class.
     *
     * @access public
     */
    public function variables(array $variables = []): self;
}
