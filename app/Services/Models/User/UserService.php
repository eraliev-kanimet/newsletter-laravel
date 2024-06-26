<?php

namespace App\Services\Models\User;

use App\Models\User;
use App\Services\Abstract\Service;
use Illuminate\Support\Facades\Auth;

class UserService extends Service
{
    public function __construct(
        readonly public User $record
    )
    {}

    public function login(): void
    {
        Auth::login($this->record);
    }

    public static function attempt(array $data): static|false
    {
        if (Auth::attempt($data)) {
            return new static(Auth::user());
        }

        return false;
    }
}
