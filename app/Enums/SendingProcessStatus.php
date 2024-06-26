<?php

namespace App\Enums;

enum SendingProcessStatus: int
{
    case pending = 0;
    case in_progress = 1;
    case completed = 2;
    case failed = 3;
    case cancelled = 4;

    public function t(): string
    {
        return __('common.' . $this->name);
    }

    public static function options(): array
    {
        $array = [];

        foreach (self::cases() as $case) {
            $array[$case->value] = $case->t();
        }

        return $array;
    }

    public static function values(): array
    {
        $array = [];

        foreach (self::cases() as $case) {
            $array[] = $case->value;
        }

        return $array;
    }
}

