<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\MessageResourceForm;
use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    public static function getEloquentQuery(): Builder
    {
        return filamentRoleFiltering(
            parent::getEloquentQuery()->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
        );
    }

    public static function getNavigationLabel(): string
    {
        return __('common.messages');
    }

    public static function getPluralLabel(): string
    {
        return __('common.messages');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(MessageResourceForm::form())
            ->columns(1);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
