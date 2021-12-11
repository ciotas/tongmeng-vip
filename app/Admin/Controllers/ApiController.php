<?php

namespace App\Admin\Controllers;

use App\Models\Exchange;
use App\Models\Market;
use App\Service\BinanceFutureService;
use App\Service\BinanceService;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function exchanges(Request $request)
    {
        $market = $request->get('q');

        return Exchange::where('market', $market)->get(['id', DB::raw('symbol as text')]);
    }

    public function latestPrice(Request $request, BinanceFutureService $binanceFutureService)
    {
        $exchange_id = $request->get('q');
        $exchange = Exchange::find($exchange_id);
        $symbol = $exchange ? $exchange->symbol : '';
        if ($symbol)
        {
            $res = $binanceFutureService->ticker_price($symbol);
            if ($res)
            {
                return ['value' => $res['price']];
            }
        }
        return ['value' => '0'];
    }
}
