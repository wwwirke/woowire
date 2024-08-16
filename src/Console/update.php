<?php

namespace Wirke\Woowire\Console;

use Illuminate\Console\Command;

class Update extends Command
{
    protected $signature = 'woowire:update';

    protected $description = 'Shortcut to update the Woowire package.';
    
    public function handle()
    {
        // publish the Traits
        $this->call('vendor:publish', [
            '--tag' => 'woowire',
            '--force' => true,
        ]);

    }
}
