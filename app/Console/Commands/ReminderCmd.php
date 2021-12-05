<?php

namespace App\Console\Commands;

use App\Models\AdminUser;
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
            $reminders = Reminder::where('online', 1)->get();
            foreach($reminders as $reminder)
            {
                $exchange = Exchange::find($reminder->exchange_id);
                $symbol = $exchange ? strtoupper($exchange->symbol) : null;
                if ($symbol) {
                    $res = $this->binance_future->ticker_price($symbol);
                    if ($res) {
                        if ($res['price'] < $reminder->price && $reminder->status == 1) {
                            $reminder->status = 0;
                            $reminder->save();
                        }
                        elseif ($res['price'] >= $reminder->price && $reminder->status == 0)
                        {
                            Log::info($res['price']);
                            // 推送提醒
                            $push_api = AdminUser::find($reminder->admin_user_id)->push_api;
                            if ($push_api) {
                                $reminder_price = floatval($reminder->price);
                                $response = $this->client->post($push_api,
                                ['form_params' => [
                                    'title' => '【提醒】'.$symbol.'价格触发'.$reminder_price,
                                    'content' => "标的：".$symbol."  触发价格：".$reminder_price."  触发时间：".Carbon::now()->toDateTimeString(),
                                    ]
                                ]);
                                Log::info('Reminder Response:');
                                Log::info(json_encode($response));
                                if ($response->getStatusCode() == 200)
                                {
                                    $reminder->status = 1;
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
            }
            // sleep(3);
        // }
        
        return Command::SUCCESS;
    }
}
