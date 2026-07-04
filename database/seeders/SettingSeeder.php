<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::insert([
            ['key' => 'company_name', 'value' => 'My Tuition CRM'],
            ['key' => 'email', 'value' => 'admin@example.com'],
            ['key' => 'phone', 'value' => '012-0000000'],
            ['key' => 'address', 'value' => '']
        ]);
    }
}
