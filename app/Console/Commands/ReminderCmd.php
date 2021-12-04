<?php

namespace App\Console\Commands;

use App\Models\Exchange;
use App\Models\Market;
use App\Models\Reminder;
use App\Models\ReminderRecord;
use App\Service\BinanceFutureService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class ReminderCmd extends Command
{
    protected $binance_future, $client;
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
    public function __construct(BinanceFutureService $binanceFutureService, Client $client)
    {
        $this->binance_future = $binanceFutureService;
        $this->client = $client;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // for($i = 0; $i < 20; $i++)
        // {
            $reminders = Reminder::all();
            foreach($reminders as $reminder)
            {
                $exchange = Exchange::find($reminder->exchange_id);
                $symbol = $exchange ? strtoupper($exchange->symbol) : null;
                if ($symbol) {
                    $res = $this->binance_future->ticker_price($symbol);
                    if ($res) {
                        if ($res['price'] >= $reminder->price && $reminder->online == 1)
                        {
                            Log::info($res['price']);
                            // 推送提醒
                            $response = $this->client->post(env('XIZHI_API'),
                            ['form_params' => [
                                'title' => $symbol.'价格触发提醒',
                                'content' => "标的：".$symbol."  触发价格：".$reminder->price."  触发时间：".Carbon::now()->toDateTimeString(),
                                ]
                            ]);
                            Log::info('Reminder Response:');
                            if ($response->getStatusCode() == 200)
                            {
                                $reminder->online = 0;
                                $reminder->save();
                                // 记录
                                ReminderRecord::create([
                                    'reminder_id' => $reminder->id,
                                    'price' => $reminder->price
                                ]);
                            }
                        }
                    }
                }
            }
            // sleep(3);
        // }
        
        return Command::SUCCESS;
    }
}
