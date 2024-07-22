<?php

use App\Console\Commands\CronTestCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(CronTestCommand::class)->everyMinute();



