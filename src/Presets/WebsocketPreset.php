<?php

namespace SaKanjo\FilamentEasyTestings\Presets;

use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Schemas;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use SaKanjo\FilamentEasyTestings\Pages\TestingsPage;

class WebsocketPreset extends Preset
{
    public static function components(): array
    {
        /** @var Model $model */
        $model = config('filament-easy-testings.websockets-preset.model');
        /** @var string $titleAttribute */
        $titleAttribute = config('filament-easy-testings.websockets-preset.model_title_attribute');
        /** @var Model $user */
        $user = Auth::user();

        $name = $user->getAttribute($titleAttribute);
        $options = $model::query()
            ->pluck($titleAttribute, $user->getKeyName());

        return [
            Schemas\Components\Section::make('Websockets')
                ->persistCollapsed()
                ->icon('heroicon-m-bolt')
                ->components([
                    Forms\Components\Select::make('user_id')
                        ->required()
                        ->label('Receiver')
                        ->default($user->getKey())
                        ->options($options),

                    Schemas\Components\Group::make([
                        Forms\Components\TextInput::make('broadcast')
                            ->default("Hello $name")
                            ->required()
                            ->hintAction(
                                Actions\Action::make('send')
                                    ->icon('heroicon-m-paper-airplane')
                                    ->action(function (mixed $state, Get $get, TestingsPage $livewire) use ($model): void {
                                        $livewire->validateFields(['user_id', 'broadcast']);

                                        $user = $model::query()
                                            ->findOrFail($get('user_id'));

                                        Notification::make()
                                            ->title($state)
                                            ->broadcast($user);
                                    })
                            ),

                        Forms\Components\TextInput::make('notification_with_broadcast')
                            ->default("Hello $name")
                            ->required()
                            ->hintAction(
                                Actions\Action::make('send')
                                    ->icon('heroicon-m-paper-airplane')
                                    ->action(function (mixed $state, Get $get, TestingsPage $livewire) use ($model): void {
                                        $livewire->validateFields(['user_id', 'notification_with_broadcast']);

                                        $user = $model::query()
                                            ->findOrFail($get('user_id'));

                                        Notification::make()
                                            ->title($state)
                                            ->sendToDatabase($user, isEventDispatched: true);
                                    })
                            ),
                    ])
                        ->columns([
                            'sm' => 2,
                        ]),
                ]),
        ];
    }
}
