<?php

namespace App\Enum;

enum TemplateType: string
{
    case EMAIL = '0';
    case SMS = '1';

    public function isEmail(): bool
    {
        return $this === static::EMAIL;
    }
    public function isSms(): bool
    {
        return $this === static::SMS;
    }
    public function getlabelText(): string
    {
        return match ($this) {
            self::EMAIL => 'Email',
            self::SMS => 'SMS',
        };
    }
}
