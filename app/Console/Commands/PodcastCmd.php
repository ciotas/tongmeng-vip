<?php

namespace App\Console\Commands;

use App\Jobs\PodcastJob;
use App\Models\Podcast;
use App\Service\BinanceFutureService;
use Illuminate\Console\Command;

class PodcastCmd extends Command
{
    protected $binanceFutureService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'podcast:cmd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '订阅提醒';

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
        for($i = 0; $i < 3; $i++) {
            $podcasts = Podcast::where('online', 1)->get();
            foreach($podcasts as $podcast)
            {
                PodcastJob::dispatch($podcast, $this->binanceFutureService );
            }
            sleep(20);
        }
        return Command::SUCCESS;
    }
}
