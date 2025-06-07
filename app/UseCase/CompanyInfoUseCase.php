<?php
namespace App\UseCase;

use App\Models\CompanyInfo;

class CompanyInfoUseCase
{
    public static function get() : ?CompanyInfo
    {
        return CompanyInfo::first();
    }
}
