<?php

namespace Kcg\Filament\Resources\UserResource\Pages;

use Kcg\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
  protected static string $resource = UserResource::class;

  protected function mutateFormDataBeforeCreate(array $data): array
  {
    if (!empty($data['password'])) {
      $data['password'] = bcrypt($data['password']);
    }

    return $data;
  }
}
