<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\FriendLink;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use App\Admin\Actions\Modal\memberModal;

class FriendLinkController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        return Grid::make(new FriendLink(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('description');
            $grid->column('url');
            $grid->column('img');
            $grid->column('follow');
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
        return Show::make($id, new FriendLink(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('description');
            $show->field('url');
            $show->field('img');
            $show->field('follow');
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
        return Form::make(new FriendLink(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('description');
            $form->text('url');
            $form->text('img');
            $form->text('follow');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
