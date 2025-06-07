<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;
use Illuminate\Support\Facades\Hash;

class CompanyInfoSeeder extends Seeder
{
    public function run(): void
    {
        CompanyInfo::create([
            'name' => '株式会社 エス・クラフト',
            'zip' => '546-0041',
            'address' => '大阪市東住吉区桑津1-32-29-1階',
            'phone_no' => '06-6776-2985',
            'fax_no' => '06-6776-2986',
            'invoice_no' => 'T7120001118616',
            'bank_name' => '尼崎信用金庫',
            'bank_branch' => '昭和町支店',
            'account_type' => '普通',
            'account_name' => '株式会社エスクラフト',
        ]);
    }
}
