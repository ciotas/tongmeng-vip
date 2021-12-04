<?php

namespace App\Service;

use Illuminate\Support\Facades\Log;
use Lin\Binance\BinanceFuture;

class BinanceFutureService
{
    protected $binance;
    public function __construct()
    {
        $this->binance = new BinanceFuture(env('BINANCE_KEY'),env('BINANCE_SECRET'));
        $this->binance->setOptions([
            //Set the request timeout to 60 seconds by default
            'timeout'=>10,
            //https://github.com/guzzle/guzzle
            'proxy'=>[],
            //https://www.php.net/manual/en/book.curl.php
            'curl'=>[],
            //default is v1
            'version'=>'v1',
        ]);
    }

    // 获取最新价格
    public function ticker_price($symbol)
    {
        try {
            return $this->binance->market()->getTickerPrice([
                'symbol'=> $symbol
            ]);
        }catch (\Exception $e){
            Log::info($e->getMessage());
            return null;
        }
        
    }

    // 获取交易对
    public function exchange_info()
    {
        try {
            return $this->binance->market()->getExchangeInfo();
        }catch (\Exception $e){
            Log::info($e->getMessage());
            return null;
        }
    }
}