<?php

namespace SaKanjo\FilamentEasyTestings;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentEasyTestingsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-easy-testings';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations()
            ->hasInstallCommand(fn (InstallCommand $command) => $command
                ->publishConfigFile()
                ->askToStarRepoOnGitHub('sakanjo/filament-easy-testings')
            );
    }
}
