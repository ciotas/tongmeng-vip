<?php

namespace App\Jobs;

use App\Models\Exchange;
use App\Models\Podcast;
use App\Service\BinanceFutureService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PodcastJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $podcast, $binanceFutureService;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Podcast $podcast, $binanceFutureService)
    {
        $this->binanceFutureService = $binanceFutureService;
        $this->podcast = $podcast;
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
        $exchange = Exchange::find($this->podcast->exchange_id);
        $symbol = $exchange ? strtoupper($exchange->symbol) : null;
        if ($symbol) {
            $res = $binance_future->ticker_price($symbol);
            Log::info('订阅推送');
            if ($res) {
                Log::info($res['price']);
                if ($res['price'] < $this->podcast->price && $this->podcast->status == 1) {
                    $this->podcast->status = 0;
                    $this->podcast->save();
                    Log::info('订阅推送，下次一定');
                }
                elseif ($res['price'] >= $this->podcast->price && $this->podcast->status == 0)
                {
                    Log::info('开始订阅推送');
                    // 推送提醒
                    $podcast_price = floatval($this->podcast->price);
                    $response = $client->post(env('XIZHI_PODCAST_API'),
                    ['form_params' => [
                        'title' => $symbol.'价格触发'.$podcast_price.';最佳周期：'.Exchange::$periods[$this->podcast->period].';操作提示：'.$this->podcast->tips,
                        'content' => "标的：".$symbol."  触发价格：".$podcast_price." 最佳周期：".Exchange::$periods[$this->podcast->period]." 操作提示：".$this->podcast->tips."  触发时间：".Carbon::now()->toDateTimeString(),
                        ]
                    ]);
                    Log::info('Podcast Response:');
                    Log::info(json_encode($response));
                    if ($response->getStatusCode() == 200)
                    {
                        $this->podcast->status = 1;
                        $this->podcast->save();
                        // 记录
                        
                    }
                }
            }
        }
    }
}
