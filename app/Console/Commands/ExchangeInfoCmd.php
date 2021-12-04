<?php

namespace App\Console\Commands;

use App\Models\Exchange;
use App\Service\BinanceFutureService;
use Illuminate\Console\Command;

class ExchangeInfoCmd extends Command
{
    protected $binance_future;
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
        $res = $this->binance_future->exchange_info();
        $arr = [];
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
        return Command::SUCCESS;
    }
}
