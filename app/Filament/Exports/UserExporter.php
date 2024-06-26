<?php

namespace App\Filament\Exports;

use App\Models\User;

class UserExporter extends BaseExporter
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        $helper = filamentExportHelper();

        return [
            $helper->column('uuid')
                ->label('UUID')
                ->enabledByDefault(false),
            $helper->columnTernary('is_active')
                ->label(__('common.active')),
            $helper->column('email')
                ->label(__('common.email')),
            $helper->column('name')
                ->label(__('common.name')),
            $helper->column('created_at')
                ->label(__('common.created_at')),
            $helper->column('updated_at')
                ->label(__('common.updated_at')),
        ];
    }
}
