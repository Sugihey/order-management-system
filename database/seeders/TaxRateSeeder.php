<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaxRate;
use Illuminate\Support\Facades\Hash;

class TaxRateSeeder extends Seeder
{
    public function run(): void
    {
        TaxRate::create([
            'apply_date' => '2004-04-01',
            'rate' => '10',
        ]);
    }
}
