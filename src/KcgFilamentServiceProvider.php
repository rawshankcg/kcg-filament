<?php

namespace Kcg\Filament;

use Filament\Support\Assets\Asset;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class KcgFilamentServiceProvider extends PackageServiceProvider
{
  public function configurePackage(Package $package): void
  {
    $package
      ->name('kcg-filament')
      ->hasConfigFile();
  }

  public function packageBooted(): void
  {
    // Auto-discover resources
    $this->discoverResources();
  }

  protected function discoverResources(): void
  {
    // Auto-register the UserResource
    \Filament\Facades\Filament::serving(function () {
      \Filament\Facades\Filament::getCurrentPanel()
        ->resources([
          Resources\UserResource::class,
        ]);
    });
  }
}
