<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->times(10)->hasPosts(10)->hasProfile()->create();
        User::factory()->times(50)->hasProfile()->hasComments(20)->hasLikes(20)->create();
    }
}
