<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Podcast;
use App\Models\Exchange;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class PodcastController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Podcast(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('market')->display(function($val) {
                return Exchange::$marketsMap[$val];
            });
            $grid->column('exchange_id')->display(function($val) {
                return Exchange::find($val)->symbol;
            });
            $grid->column('price')->display(function($val) {
                return floatval($val);
            });
            $grid->column('period')->display(function($val) {
                return Exchange::$periods[$val];
            });
            $grid->column('image')->image('', 80,80);
           
            $grid->column('tips')->display('查看')->modal(function ($modal) {
                // 设置弹窗标题
                $symbol = Exchange::find($this->exchange_id)->symbol;
                $modal->title($symbol.'行情提示');
                // 自定义图标
                $modal->icon('feather  icon-file-text');
                return $this->tips;
            });        
            $grid->column('updated_at')->sortable();
        
            $grid->disableViewButton();
            if (Admin::user()->getKey() > 1) {
                $grid->disableEditButton();
                $grid->disableDeleteButton();
                $grid->disableCreateButton();
            }
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Podcast(), function (Form $form) {
            $form->display('id');
            $form->select('market')->options(Exchange::$marketsMap)->load('exchange_id', 'api/exchanges')->default(Exchange::BINANCE_FUTURES_USDT);
            $form->select('exchange_id');
            $form->select('period')->options(Exchange::$periods)->help('大周期-小周期-极小周期');
            $form->decimal('price');
            $form->image('image')
            ->uniqueName()
            ->move('images')
            ->accept('jpg,png,gif,jpeg', 'image/*')
            ->chunkSize(1024)
            ->autoUpload();

            $form->textarea('tips');
            $form->switch('online');
            $form->disableViewCheck();
            $form->disableViewButton();
        });
    }
}
