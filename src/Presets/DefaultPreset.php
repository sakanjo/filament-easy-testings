<?php

namespace SaKanjo\FilamentEasyTestings\Presets;

use Filament\Panel;

class DefaultPreset extends Preset
{
    /** @var class-string<Preset>[] */
    public static array $presets = [
        EnvPreset::class,
        WebsocketPreset::class,
    ];

    public static function boot(Panel $panel): void
    {
        foreach (static::$presets as $preset) {
            $preset::boot($panel);
        }
    }

    public static function register(Panel $panel): void
    {
        foreach (static::$presets as $preset) {
            $preset::register($panel);
        }
    }

    public static function components(): array
    {
        return collect(static::$presets)
            ->flatMap(fn (string $preset) => $preset::components())
            ->toArray();
    }
}
