<?php
namespace App\Enums;

enum OrderType :string
{
    case RECOVER = 'recover';
    case REPAIR = 'repair';

    public function label(): string
    {
        return match($this) {
            self::RECOVER => '原状回復',
            self::REPAIR => '修繕',
            default => '',
        };
    }
}