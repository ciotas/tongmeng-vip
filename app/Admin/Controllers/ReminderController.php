<?php

namespace App\Admin\Controllers;

use App\Models\Exchange;
use App\Models\Market;
use App\Models\Reminder;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ReminderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Reminder(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('market', '交易所')->display(function($val) {
                return Exchange::$marketsMap[$val];
            });
            $grid->column('exchange_id')->display(function($val) {
                $exchange = Exchange::find($val);
                return $exchange ? $exchange->symbol : '';
            });
            $grid->column('peroid')->display(function($val) {
                return Exchange::$periods[$val];
            });
            $grid->column('price');
            $grid->column('online')->switch();
            $grid->column('updated_at')->sortable();
        
            $grid->disableViewButton();
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
        return Form::make(new Reminder(), function (Form $form) {
            $form->display('id');
            $form->select('market', '交易所')->options(Exchange::$marketsMap)->load('exchange_id', 'api/exchanges');
            $form->select('exchange_id');
            $form->select('peroid')->options(Exchange::$periods)->help('大周期-小周期-极小周期');
            $form->decimal('price');
            $form->switch('online');
            $form->hidden('admin_user_id');
            $form->display('created_at');
            $form->display('updated_at');
            $form->disableViewButton();
            $form->disableViewCheck();
            $form->saving(function(Form $form) {
                $form->admin_user_id = Admin::user()->getKey();
            });
        });
    }
}
