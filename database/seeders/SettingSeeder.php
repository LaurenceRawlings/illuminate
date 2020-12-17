<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new Setting())->fill(array('key' => 'lastUpdated', 'value' => now()))->save();
        (new Setting())->fill(array('key' => 'updateInterval', 'value' => '3'))->save();
    }
}
