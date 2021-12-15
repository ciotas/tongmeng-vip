<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Http\Controllers\Controller;
use Dcat\Admin\Http\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('行情图')
            ->body(
                $card = Card::make(view('admin.tradingview'))
            );
    }

    public function getFeeds()
    {
        return Redirect::to('http://news.10jqka.com.cn/clientinfo/24hourscroll.html###');
    }
}
