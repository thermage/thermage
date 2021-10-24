<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Themes\Theme;
use Termage\Themes\ThemeInterface;

test('test set and get theme', function (): void {
    $this->assertInstanceOf(Theme::class, Termage::getTheme());

    Termage::setTheme(new FooTheme());
    $this->assertInstanceOf(FooTheme::class, Termage::getTheme());
});

test('test get theme variables', function (): void {
    expect(Termage::getTheme()->getThemeVariables())->toBeArray();
});

test('test get theme variables object', function (): void {
    expect(Termage::getTheme()->variables()->toArray())->toBeArray();
});

class FooTheme extends Theme implements ThemeInterface {
    public function getThemeVariables(): array
    {
        return [];
    }
}