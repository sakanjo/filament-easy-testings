<?php

namespace SaKanjo\FilamentEasyTestings\Pages;

use BackedEnum;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;
use SaKanjo\FilamentEasyTestings\EasyTestingsPlugin;

/**
 * @property-read Schema $form
 */
class TestingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-m-beaker';

    protected string $view = 'filament-easy-testings::index';

    protected static ?string $slug = 'testings';

    public function getTitle(): string|Htmlable
    {
        return __('Testings page');
    }

    public static function getNavigationLabel(): string
    {
        return __('Testings');
    }

    public ?array $data = [];

    public function validateFields(array $fields): void
    {
        $allRules = $this->form->getValidationRules();
        $rules = collect($allRules)
            ->filter(function (array $_, string $rule) use ($fields): bool {
                $key = (string) str($rule)->after('data.');

                return in_array($key, $fields);
            })
            ->toArray();

        $this->validate($rules);
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $form): Schema
    {
        $components = EasyTestingsPlugin::get()
            ->getPreset()->components();

        return $form
            ->components($components)
            ->statePath('data');
    }
}
