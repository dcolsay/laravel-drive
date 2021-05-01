<?php

namespace Dcolsay\Drive\Filament\Resources;

use Dcolsay\Drive\Filament\Resources\DriveResource\Pages;
use App\Filament\Resources\DriveResource\RelationManagers;
use App\Filament\Roles;
use Dcolsay\Drive\Models\File;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class DriveResource extends Resource
{
    public static $icon = 'heroicon-o-collection';

    public static $model = File::class;

    public static function form(Form $form)
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('name'),
                Columns\Icon::make('transfer')
                    ->action('handleTransfer')
                    ->options(['heroicon-s-check-circle' => fn () => true]), // When the `status` is `accepted`, render the `check-circle` Heroicon.
            ])
            ->filters([
                //
            ]);
    }

    public static function relations()
    {
        return [
            //
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListDrives::routeTo('/', 'index'),
            // Pages\CreateDrive::routeTo('/create', 'create'),
            Pages\EditDrive::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
