<?php

namespace Wirke\Woowire\Console;

use Illuminate\Console\Command;

class Publish extends Command
{
    protected $signature = 'woowire:publish';

    protected $description = 'Shortcut to publish the Woowire package.';
    
    public function handle()
    {
        // publish the Traits
        $this->call('vendor:publish', [
            '--provider' => 'Wirke\Woowire\WooWireServiceProvider',
            '--tag' => 'woowire',
        ]);
    }
}
