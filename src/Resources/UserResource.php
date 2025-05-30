<?php

namespace Kcg\Filament\Resources;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Kcg\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
  protected static ?string $model = User::class;
  protected static ?string $navigationIcon = 'heroicon-o-users';
  protected static ?string $navigationLabel = 'Users';
  protected static ?string $modelLabel = 'User';
  protected static ?string $pluralModelLabel = 'Users';

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
          ->maxLength(255)
          ->unique(User::class, 'email', ignoreRecord: true),
        Forms\Components\DateTimePicker::make('email_verified_at'),
        Forms\Components\TextInput::make('password')
          ->password()
          ->required(fn(string $context): bool => $context === 'create')
          ->minLength(8)
          ->dehydrated(fn($state): bool => filled($state)),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('id')
          ->sortable(),
        Tables\Columns\TextColumn::make('name')
          ->searchable()
          ->sortable(),
        Tables\Columns\TextColumn::make('email')
          ->searchable()
          ->sortable(),
        Tables\Columns\TextColumn::make('email_verified_at')
          ->dateTime()
          ->sortable(),
        Tables\Columns\TextColumn::make('created_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->filters([
        //
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

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListUsers::route('/'),
      'create' => Pages\CreateUser::route('/create'),
      'edit' => Pages\EditUser::route('/{record}/edit'),
    ];
  }
}
