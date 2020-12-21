<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->times(10)->hasPosts(10)->hasProfile()->create();
        User::factory()->times(50)->hasProfile()->hasComments(20)->create();

        $this->call([
            SettingSeeder::class,
        ]);
    }
}
