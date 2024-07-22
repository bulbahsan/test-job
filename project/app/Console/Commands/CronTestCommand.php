<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CronTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cron-test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test cron command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        file_put_contents(base_path('cron.log'), date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
    }
}
