<?php

namespace App\Console\Commands;

use App\Jobs\ReminderJob;
use App\Models\Reminder;
use App\Service\BinanceFutureService;
use Illuminate\Console\Command;

class ReminderCmd extends Command
{
    protected $binanceFutureService; 
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '价格提醒';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(BinanceFutureService $binanceFutureService)
    {
        $this->binanceFutureService = $binanceFutureService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        for($i = 0; $i < 3; $i++)
        {
            $reminders = Reminder::where('online', 1)->get();
            foreach($reminders as $reminder)
            {
                ReminderJob::dispatch($reminder, $this->binanceFutureService);
            }
            sleep(20);
        }
        
        return Command::SUCCESS;
    }
}
