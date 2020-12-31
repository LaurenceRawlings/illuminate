<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Jetstream::inertia()->whenRendering(
            'Profile/Show',
            function (Request $request, array $data) {
                return array_merge($data, [
                    'bio' => $request->user()->profile->bio,
                    'status_text' => $request->user()->profile->status_text,
                    'status_emoji' => $request->user()->profile->status_emoji,
                ]);
            }
        );
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
