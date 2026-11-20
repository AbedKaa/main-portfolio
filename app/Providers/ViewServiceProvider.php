<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // SiteSetting::current() is memoised per request and cached, so this
        // composer no longer runs a query for every view and component.
        View::composer('*', function ($view) {
            $view->with('settings', SiteSetting::current());
        });
    }
}
