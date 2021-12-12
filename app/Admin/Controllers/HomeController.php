<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Http\Controllers\Controller;
use Dcat\Admin\Http\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('Dashboard')
            ->description('Description...')
            ->body(
                $card = Card::make(view('admin.tradingview'))
            );
    }
}
