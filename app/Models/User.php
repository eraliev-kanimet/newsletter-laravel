<?php

namespace App\Models;

use App\Traits\Models\UserTrait;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasName
{
    use Notifiable, UserTrait, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'is_active',
        'uuid',
        'email',
        'name',
        'password',
        'roles',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'roles' => 'array',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function (self $user) {
            $user->uuid = Str::uuid();
        });

        self::saving(function (self $user) {
            if ($user->isDirty('roles')) {
                $user->roles = convertArrayToIntegers($user->roles);
            }
        });
    }

    public function getFilamentName(): string
    {
        return $this->name ?? __('common.no_name');
    }
}
