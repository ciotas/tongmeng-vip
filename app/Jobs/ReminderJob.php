<?php

namespace App\Jobs;

use App\Models\AdminUser;
use App\Models\Exchange;
use App\Models\Reminder;
use App\Models\ReminderRecord;
use App\Service\BinanceFutureService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class ReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reminder, $binanceFutureService;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Reminder $reminder, $binanceFutureService)
    {
        $this->binanceFutureService = $binanceFutureService;
        $this->reminder = $reminder;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $binance_future = $this->binanceFutureService;
        $client = new Client();

        $exchange = Exchange::find($this->reminder->exchange_id);
        $symbol = $exchange ? strtoupper($exchange->symbol) : null;
        if ($symbol) {
            $res = $binance_future->ticker_price($symbol);
            Log::info('提醒推送');
            if ($res) {
                Log::info($res['price']);
                if ($res['price'] < $this->reminder->price && $this->reminder->status == 1) {
                    $this->reminder->status = 0;
                    $this->reminder->save();
                    Log::info('提醒推送，下次一定');
                }
                elseif ($res['price'] >= $this->reminder->price && $this->reminder->status == 0)
                {
                    Log::info('开始提醒推送');
                    // 推送提醒
                    $push_api = AdminUser::find($this->reminder->admin_user_id)->push_api;
                    if ($push_api) {
                        $reminder_price = floatval($this->reminder->price);
                        $response = $client->post($push_api,
                        ['form_params' => [
                            'title' => '【提醒】'.$symbol.'价格触发'.$reminder_price.' 最佳周期：'.Exchange::$periods[$this->reminder->peroid],
                            'content' => "标的：".$symbol."  触发价格：".$reminder_price."  触发时间：".Carbon::now()->toDateTimeString(),
                            ]
                        ]);
                        Log::info('Reminder Response:');
                        Log::info(json_encode($response));
                        if ($response->getStatusCode() == 200)
                        {
                            $this->reminder->status = 1;
                            $this->reminder->save();
                            // 记录
                            ReminderRecord::create([
                                'reminder_id' => $this->reminder->id,
                                'price' => $this->reminder->price
                            ]);
                        }
                    }
                    
                }
            }
        }
    }
}
