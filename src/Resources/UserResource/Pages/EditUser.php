<?php

namespace Kcg\KcgFilament\Resources\UserResource\Pages;

use Kcg\KcgFilament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
  protected static string $resource = UserResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Actions\DeleteAction::make(),
    ];
  }
}
