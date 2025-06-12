<?php
namespace App\Enums;

enum Priority :string
{
    case NORMAL = 'normal';
    case URGENT = 'urgent';

    public function label(): string
    {
        return match($this) {
            self::NORMAL => '通常',
            self::URGENT => '緊急',
            default => '',
        };
    }
}