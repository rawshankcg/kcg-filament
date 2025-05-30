<?php

namespace Kcg\KcgFilament\Resources\UserResource\Pages;

use Kcg\KcgFilament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
  protected static string $resource = UserResource::class;
}
