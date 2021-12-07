<?php

namespace App\Console\Commands;

use App\Jobs\ExchangeInfoJob;
use App\Models\Exchange;
use App\Service\BinanceFutureService;
use Illuminate\Console\Command;

class ExchangeInfoCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '获取交易对';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ExchangeInfoJob::dispatch();
        return Command::SUCCESS;
    }
}
