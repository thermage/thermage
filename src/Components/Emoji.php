<?php

declare(strict_types=1);

namespace Termage\Components;

use Spatie\Emoji\Emoji as SpatieEmoji;
use Termage\Base\Element;

use function defined;
use function strings;

final class Emoji extends Element
{
    /**
     * Dynamically bind magic methods to the Emoji class.
     *
     * @param string $method     Method.
     * @param array  $parameters Parameters.
     *
     * @return mixed Returns mixed content.
     *
     * @throws BadMethodCallException If method not found.
     *
     * @access public
     */
    public function __call(string $method, array $parameters)
    {
        $emojiConstantName = 'CHARACTER_' . (string) strings($method)->snake()->upper();
        if (defined("Spatie\Emoji\Emoji::{$emojiConstantName}")) {
            $this->getValue()->append(SpatieEmoji::$method());

            return $this;
        }

        return parent::__call($method, $parameters);
    }

    /**
     * Get country flag.
     * 
     * @param string $countryCode Country code.
     * 
     * @return array Returns country flag.
     *
     * @access public
     */
    public function countryFlag(string $countryCode): self
    {
        $this->getValue()->append(SpatieEmoji::countryFlag($countryCode));

        return $this;
    }

    /** 
     * Get all emoji.
     * 
     * @return array Returns emoji array.
     *
     * @access public
     */
    public function all(): array
    {
        return SpatieEmoji::all();
    }
}
