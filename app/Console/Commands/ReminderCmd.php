<?php

namespace App\Console\Commands;

use App\Models\Exchange;
use App\Models\Market;
use App\Models\Reminder;
use App\Service\BinanceFutureService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class ReminderCmd extends Command
{
    protected $binance_future;
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
        $this->binance_future = $binanceFutureService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client();
        $reminders = Reminder::all();
        foreach($reminders as $reminder)
        {
            $exchange = Exchange::find($reminder->exchange_id);
            $symbol = $exchange ? strtoupper($exchange->symbol) : null;
            if ($symbol) {
                $res = $this->binance_future->ticker_price($symbol);
                if ($res) {
                    if ($res['price'] >= $reminder->price) // $res['price'] >= $reminder->price
                    {
                        Log::info($res['price']);
                        // 推送提醒
                        $response = $client->post(env('XIZHI_API'),
                        ['form_params' => [
                            'title' => $symbol.'价格触发提醒',
                            'content' => "标的：".$symbol."  触发价格：".$res['price']."  触发时间：".Carbon::now()->toDateTimeString(),
                            ]
                        ]);
                    }
                }
            }
        }

        return Command::SUCCESS;
    }
}
