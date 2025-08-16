<?php

namespace SaKanjo\FilamentEasyTestings\Presets;

use Filament\Panel;

abstract class Preset
{
    public static function make(): static
    {
        return app(static::class);
    }

    public static function register(Panel $panel): void
    {
        //
    }

    public static function boot(Panel $panel): void
    {
        //
    }

    abstract public static function components(): array;
}
