<?php

declare(strict_types=1);

use Thermage\Thermage;
use Thermage\Themes\Theme;
use Thermage\Themes\ThemeInterface;
use Glowy\Arrays\Arrays as Collection;
use function Glowy\Arrays\arrays as collection;

test('test set and get theme', function (): void {
    $this->assertInstanceOf(Theme::class, Thermage::getTheme());

    Thermage::setTheme(new FooTheme());
    $this->assertInstanceOf(FooTheme::class, Thermage::getTheme());
});

test('test get theme variables', function (): void {
    expect(Thermage::getTheme()->getThemeVariables()->toArray())->toBeArray();
});

test('test get theme variables object', function (): void {
    expect(Thermage::getTheme()->getVariables()->toArray())->toBeArray();
});

class FooTheme extends Theme implements ThemeInterface {
    public function getThemeVariables(): Collection
    {
        return collection();
    }
}