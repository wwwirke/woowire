<?php

namespace Wirke\Woowire;

use Illuminate\Support\ServiceProvider;
use Wirke\Woowire\Console\Publish;

class WoowireServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Publish::class,
            ]);
        }

        // the files to publish
        $this->publishes([
            __DIR__.'/app/Livewire' => app_path('Livewire'),
        ], 'woowire');

        $this->publishes([
            __DIR__.'/app/Traits' => app_path('Traits'),
        ], 'woowire');
        
        $this->publishes([
            __DIR__.'/app/View/Components' => app_path('View/Components'),
        ], 'woowire');


        $this->publishes([
            __DIR__.'/resources/views/components' => resource_path('views/components'),
        ], 'woowire');

        $this->publishes([
            __DIR__.'/resources/views/layouts' => resource_path('views/layouts'),
        ], 'woowire');

        $this->publishes([
            __DIR__.'/resources/views/livewire' => resource_path('views/livewire'),
        ], 'woowire');

        $this->publishes([
            __DIR__.'/resources/views/woocommerce' => resource_path('views/woocommerce'),
        ], 'woowire');

    }
}
