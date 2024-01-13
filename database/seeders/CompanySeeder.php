<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'company_name' => 'Coca-Cola',
            'street_address' => '東京都',
            'representative_name' => 'ホルヘ・ガルドゥニョ'
        ]);
        Company::create([
            'company_name' => 'サントリー',
            'street_address' => '大阪府',
            'representative_name' => '佐治信忠'
        ]);
        Company::create([
            'company_name' => 'キリン',
            'street_address' => '東京都',
            'representative_name' => '磯崎功典'
        ]);
    }
}
