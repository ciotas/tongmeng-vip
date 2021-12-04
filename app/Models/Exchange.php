<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
	use HasDateTimeFormatter;    
	protected $fillable = ['market', 'symbol', 'pair', 'pricePrecision', 'quantityPrecision', 'quoteAsset', 'baseAsset'];

	const BINANCE_FUTURES_USDT = 'binance_futures_usdt';
	public static $marketsMap = 
	[
		self::BINANCE_FUTURES_USDT => '币安U本位合约'
	];

	
	public static $periods =
	[
		// '1w-1d-1h',
		'1d-4h-15min',
		'4h-1h-5min',
		'1h-15min-1min',
		'30min-5min-1min',
		'15min-3min-1min'
	];
}
