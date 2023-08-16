<?php

namespace Filament;

use Filament\Infolists\Commands;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SpatieLaravelMediaLibraryServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-media-library')
            ->hasViews();
    }

}
