<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Member;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use App\Admin\Actions\Modal\memberModal;

class MemberController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Member(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('username');
            $grid->column('user_avatar');
            $grid->column('cretated_at');
            $grid->column('updated_at');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->tools(function  (Grid\Tools  $tools)  {
                //Excel导入
                $tools->append(new  memberModal());
            });

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
        return Show::make($id, new Member(), function (Show $show) {
            $show->field('id');
            $show->field('username');
            $show->field('user_avatar');
            $show->field('cretated_at');
            $show->field('updated_at');
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
        return Form::make(new Member(), function (Form $form) {
            $form->display('id');
            $form->text('username');
            $form->text('user_avatar');
            $form->text('cretated_at');
            $form->text('updated_at');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
