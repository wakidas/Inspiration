<?php

namespace inspiration\Providers;

use Illuminate\Support\ServiceProvider;
use inspiration\Http\ViewComposers\UserComposer;
use Illuminate\Support\Facades\View;
use inspiration\Http\ViewComposers\CategoryComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composers([
            UserComposer::class    => '*',
            CategoryComposer::class => '*'
        ]);
    }
}
