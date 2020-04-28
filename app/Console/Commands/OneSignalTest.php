<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OneSignalTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:one-signal-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Teste');
        \OneSignal::sendNotificationToUser(
            "Teste",
            'c3c62ca9-d777-4c4d-8b53-dae88a167e65',
            null,
            null,
            null,
            null,
            'headings',
            'subtitle'
        );
    }
}
