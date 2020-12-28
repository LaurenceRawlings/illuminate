<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AddAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:add {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a user an administrator';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::query()->where('username', $this->argument('username'))->first();

        if (!$user) {
            $this->error('User not found!');
            return 1;
        }

        $user->forceFill([
            'is_admin' => true,
        ])->save();

        $this->info($user->username.' is now an admin!');

        return 0;
    }
}
