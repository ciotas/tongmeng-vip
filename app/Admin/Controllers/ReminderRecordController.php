<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\ReminderRecord;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ReminderRecordController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ReminderRecord(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('reminder_id');
            $grid->column('price');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new ReminderRecord(), function (Show $show) {
            $show->field('id');
            $show->field('reminder_id');
            $show->field('price');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new ReminderRecord(), function (Form $form) {
            $form->display('id');
            $form->text('reminder_id');
            $form->text('price');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
