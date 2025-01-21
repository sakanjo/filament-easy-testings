<?php

namespace SaKanjo\FilamentEasyTestings\Presets;

use Filament\Forms;
use Illuminate\Support\Arr;

class EnvPreset extends Preset
{
    public static function getSchema(): array
    {
        return Arr::map(
            config('filament-easy-testings.env-preset.keys'),
            fn (mixed $value, string $key) => is_bool($value)
                ? Forms\Components\Toggle::make($key)
                    ->label($key)
                    ->default($value)
                    ->disabled()

                : Forms\Components\Placeholder::make($key)
                    ->label($key)
                    ->content($value)
        );
    }

    public static function schema(): array
    {
        return [
            Forms\Components\Section::make(__('Environment variables'))
                ->persistCollapsed()
                ->icon('heroicon-m-information-circle')
                ->schema([
                    Forms\Components\Fieldset::make(__('Caching'))
                        ->schema([
                            Forms\Components\Toggle::make('config')
                                ->default(app()->configurationIsCached())
                                ->disabled(),

                            Forms\Components\Toggle::make('events')
                                ->default(app()->eventsAreCached())
                                ->disabled(),

                            Forms\Components\Toggle::make('routes')
                                ->default(app()->routesAreCached())
                                ->disabled(),

                            Forms\Components\Toggle::make('views')
                                ->default(function (): bool {
                                    $path = app()->storagePath('framework/views');

                                    return ! empty(glob($path.'/*.php'));
                                })
                                ->disabled(),
                        ]),

                    Forms\Components\Grid::make([
                        'sm' => 2,
                        'md' => 3,
                    ])
                        ->schema(static::getSchema()),
                ]),
        ];
    }
}
