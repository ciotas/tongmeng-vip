<?php

namespace App\Admin\Controllers;

use App\Models\AdminUser;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new AdminUser(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('username');
            $grid->column('name');
            // $grid->column('avatar');
            $grid->column('push_api');
            $grid->column('points');
            $grid->column('created_at');
        
            $grid->disableCreateButton();
            $grid->disableBatchActions();
            $grid->disableDeleteButton();
            $grid->disableViewButton();
            $grid->disableRowSelector();
            
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new AdminUser(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('username');
            $form->password('password')->help('如果密码没改变，不用修改!');
            
            // $form->image('avatar')
            // ->uniqueName()
            // ->move('images')
            // ->accept('jpg,png,gif,jpeg', 'image/*')
            // ->chunkSize(1024)
            // ->autoUpload();
            $form->url('push_api');

            $form->saving(function (Form $form) {
                if (strlen($form->password) != 60)
                {
                    $form->password = Hash::make($form->password);
                }
                
            });
            $form->disableViewButton();
            $form->disableViewCheck();
            $form->disableEditingCheck();
        });
    }
}
