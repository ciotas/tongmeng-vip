<?php

namespace App\Jobs;

use App\Models\Exchange;
use App\Service\BinanceFutureService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExchangeInfoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $binance_future = new BinanceFutureService();
        $res = $binance_future->exchange_info();
        if ($res) {
            $symbols = $res['symbols'];
            foreach($symbols as $symbol)
            {
                $exchange = Exchange::where(['market'=> Exchange::BINANCE_FUTURES_USDT, 'symbol'=>$symbol['symbol']])->first();
                if (!$exchange && ($symbol['status'] == 'TRADING')) {
                    Exchange::create([
                        'symbol' => $symbol['symbol'],
                        'pair' => $symbol['pair'],
                        'pricePrecision' => $symbol['pricePrecision'],
                        'quantityPrecision' => $symbol['quantityPrecision'],
                        'quoteAsset' => $symbol['quoteAsset'],
                        'baseAsset' => $symbol['baseAsset'],
                        'market' => Exchange::BINANCE_FUTURES_USDT
                    ]);
                }
                
                if ($exchange && ($symbol['status'] != 'TRADING'))
                {
                    $exchange->delete();
                }
                
            }
        }
    }
}
