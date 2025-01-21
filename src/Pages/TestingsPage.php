<?php

namespace SaKanjo\FilamentEasyTestings\Pages;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use SaKanjo\FilamentEasyTestings\EasyTestingsPlugin;

/**
 * @property Form $form
 */
class TestingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-m-beaker';

    protected static string $view = 'filament-easy-testings::index';

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

    public function form(Form $form): Form
    {
        $schema = EasyTestingsPlugin::get()
            ->getPreset()->schema();

        return $form
            ->schema($schema)
            ->statePath('data');
    }
}
