<?php

namespace Kcg\Filament\Resources\UserResource\Pages;

use Kcg\Filament\Resources\UserResource;
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

  protected function mutateFormDataBeforeSave(array $data): array
  {
    if (!empty($data['password'])) {
      $data['password'] = bcrypt($data['password']);
    } else {
      unset($data['password']);
    }

    return $data;
  }
}
