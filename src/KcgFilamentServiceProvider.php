<?php

namespace Kcg\KcgFilament;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Kcg\KcgFilament\Resources\UserResource;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class KcgFilamentServiceProvider extends PackageServiceProvider implements Plugin
{
  public function configurePanel(Panel $panel): void
  {
    $panel
      ->resources([
        UserResource::class,
      ]);
  }

  public function configurePackage(Package $package): void
  {
    $package
      ->name('kcg-filament')
      ->hasConfigFile()
      ->hasViews()
      ->hasMigration('add_user_fields')
      ->hasTranslations();
  }

  public function boot()
  {
    parent::boot();

    Panel::configureUsing(function (Panel $panel) {
      $panel->plugin($this);
    });
  }
}
