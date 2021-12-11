<?php

namespace App\Admin\Controllers;

use App\Models\Barn;
use App\Models\Exchange;
use App\Service\BinanceFutureService;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

class BarnController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Barn(), function (Grid $grid) {
            if ( Admin::user()->getKey() > 1) {
                $grid->model()->where('admin_user_id', Admin::user()->getKey());
            }
            // $grid->column('id')->sortable();
            // $grid->column('market')->display(function($val) {
            //     return Exchange::$marketsMap[$val];
            // });
            $grid->column('exchange_id')->display(function($val) {
                $exchange = Exchange::find($val);
                return $exchange ? $exchange->symbol : '';
            });
            $grid->column('period')->display(function($val) {
                return Exchange::$periods[$val];
            });
            $grid->column('buy_price')->display(function($val) {
                return floatval($val);
            })->editable();
     
            $grid->column('stoploss_price')->display(function($val) {
                return floatval($val);
            })->editable();
            $grid->column('calc_amount', '理论仓位')->display(function($val) {
                if ($this->market == Exchange::BINANCE_FUTURES_USDT){
                    $max_loss = Admin::user()->crpto_max_loss ?? 0;
                }
                return sprintf('%.4f', $max_loss / ($this->buy_price - $this->stoploss_price));
            });
            // $grid->column('real_amount')->display(function($val) {
            //     return floatval($val);
            // })->editable();
           
            $grid->column('images')->image('', 60, 60);

            $grid->column('profit_rate', '最新收益率')->display(function() {
                $exchange = Exchange::find($this->exchange_id);
                $symbol = $exchange ? $exchange->symbol : '';
                if ($symbol) {
                    $binance = new BinanceFutureService();
                    $res = $binance->ticker_price($symbol);
                    if ($res) {
                        return sprintf('%.2f', 100 * ($res['price'] - $this->stoploss_price) / $res['price']).'%';
                    }
                }
               
                return '';
            });
            $grid->column('updated_at');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
            $grid->disableViewButton();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Barn(), function (Form $form){
            $form->display('id');
            $form->select('market')->options(Exchange::$marketsMap)->load('exchange_id', 'api/exchanges')->default(Exchange::BINANCE_FUTURES_USDT)->rules('required');
            $form->select('exchange_id')->rules('required');//->load('buy_price', 'api/price');
            $form->select('period')->options(Exchange::$periods)->rules('required');
            $form->decimal('buy_price');
            $form->decimal('stoploss_price');           
            $form->multipleImage('images')
            ->uniqueName()
            ->move('images')
            ->accept('jpg,png,gif,jpeg', 'image/*')
            ->chunkSize(1024)
            ->autoUpload()
            ->sortable()
            ->help('可为空，可同时上传质变图、挂单位置图、离场图等');
            $form->hidden('admin_user_id');
            $form->disableViewButton();
            $form->disableViewCheck();
            $form->saving(function(Form $form) {
                $form->admin_user_id = Admin::user()->getKey();
            });
        });
    }
}
