<?php

declare(strict_types=1);

/**
 * Termage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/termage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License.
 *
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 */

namespace Termage\Themes;

use Atomastic\Arrays\Arrays as Collection;

interface ThemeInterface
{
    /**
     * Get Theme custom variables.
     *
     * @return Collection Collection of theme custom variables.
     *
     * @access public
     */
    public function getThemeVariables(): Collection;

    /**
     * Get theme variables.
     *
     * @return Collection Collecton of theme variables.
     *
     * @access public
     */
    public function getVariables(): Collection;

    /**
     * Set theme variables.
     *
     * @param array $variables Theme variables.
     *
     * @return self Returns instance of the Theme class.
     *
     * @access public
     */
    public function variables(array $variables = []): self;
}
