<?php

namespace SaKanjo\FilamentEasyTestings;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;

class EasyTestingsPlugin implements Plugin
{
    use Concerns\HasPreset;
    use Concerns\HasVisibility;
    use EvaluatesClosures;

    public function getId(): string
    {
        return 'sakanjo/easy-testings';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        // @phpstan-ignore-next-line
        return filament(
            app(static::class)->getId()
        );
    }

    public function register(Panel $panel): void
    {
        if (! $this->isVisible()) {
            return;
        }

        $this->getPreset()->register($panel);

        $panel->pages([
            Pages\TestingsPage::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        if (! $this->isVisible()) {
            return;
        }

        $this->getPreset()->boot($panel);
    }
}
