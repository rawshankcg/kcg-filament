<?php

namespace Kcg\KcgFilament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
  protected static ?string $model = \App\Models\User::class;

  protected static ?string $navigationIcon = 'heroicon-o-users';

  protected static ?int $navigationSort = 1;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('name')
          ->required()
          ->maxLength(255),
        Forms\Components\TextInput::make('email')
          ->email()
          ->required()
          ->maxLength(255),
        Forms\Components\DateTimePicker::make('email_verified_at'),
        Forms\Components\TextInput::make('password')
          ->password()
          ->required()
          ->maxLength(255)
          ->hiddenOn('edit')
          ->visibleOn('create'),
        Forms\Components\Select::make('roles')
          ->relationship('roles', 'name')
          ->multiple()
          ->preload(),
        Forms\Components\Select::make('permissions')
          ->relationship('permissions', 'name')
          ->multiple()
          ->preload(),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->searchable(),
        Tables\Columns\TextColumn::make('email')
          ->searchable(),
        Tables\Columns\TextColumn::make('email_verified_at')
          ->dateTime()
          ->sortable(),
        Tables\Columns\TextColumn::make('created_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        Tables\Columns\TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->filters([
        Tables\Filters\Filter::make('verified')
          ->query(fn(Builder $query) => $query->whereNotNull('email_verified_at'))
          ->label('Verified Users'),
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make(),
        ]),
      ]);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => \Kcg\KcgFilament\Resources\UserResource\Pages\ListUsers::route('/'),
      'create' => \Kcg\KcgFilament\Resources\UserResource\Pages\CreateUser::route('/create'),
      'edit' => \Kcg\KcgFilament\Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
    ];
  }

  public static function getNavigationGroup(): ?string
  {
    return config('kcg-filament.navigation_group', 'System');
  }
}
