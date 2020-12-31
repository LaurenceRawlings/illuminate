<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class RemoveAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:remove {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove administrator privileges from a user';

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
    public function handle(): int
    {
        $user = User::query()->where('username', $this->argument('username'))->first();

        if (!$user) {
            $this->error('User not found!');
            return 1;
        }

        if (!$user->is_admin) {
            $this->error('This user is not an admin!');
            return 1;
        }

        $user->forceFill([
            'is_admin' => false,
        ])->save();

        $this->info($user->username . ' is no longer an admin!');

        return 0;
    }
}
