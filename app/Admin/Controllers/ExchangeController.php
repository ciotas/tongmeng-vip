<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Exchange;
use App\Models\Exchange as ModelsExchange;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ExchangeController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Exchange(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('market')->display(function($val) {
                return ModelsExchange::$marketsMap[$val];
            });
            $grid->column('pair');
            $grid->column('quoteAsset');
            $grid->column('baseAsset');
            $grid->column('pricePrecision');
            $grid->column('quantityPrecision');
            
            $grid->disableActions();
            $grid->disableCreateButton();
            $grid->disableBatchActions();
            $grid->disableRowSelector();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('market')->select(ModelsExchange::$marketsMap);
                $filter->like('symbol');
        
            });
        });
    }


    
}
