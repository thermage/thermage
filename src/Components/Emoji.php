<?php

declare(strict_types=1);

namespace Termage\Components;

use Termage\Base\Element;
use Spatie\Emoji\Emoji as SpatieEmoji;

use function strings;

final class Emoji extends Element
{
    public function __call(string $method, array $parameters)
    {
        $emojiConstantName = 'CHARACTER_' . (string) strings($method)->snake()->upper();
        if (defined("Spatie\Emoji\Emoji::{$emojiConstantName}")) {
            $this->getValue()->append(SpatieEmoji::$method());

            return $this;
        }

        return parent::__call($method, $parameters);        
    }

    public function countryFlag(string $countryCode): self
    {
        $this->getValue()->append(SpatieEmoji::countryFlag($countryCode));

        return $this;
    }

    public function all() 
    {
        return SpatieEmoji::all(); 
    }

    protected static function convertCharacterNameToConstantName(string $characterName): string
    {
        return 'CHARACTER_' . (string) strings($characterName)->snake()->upper();
    }
}
