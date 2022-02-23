<?php

namespace App\Admin\Controllers;

use App\Models\ConfigSmsTmp;
use App\Models\AdminConfig;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ConfigSmsTmpController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ConfigSmsTmp(), function (Grid $grid) {
            $grid->addTableClass(['table-text-center']);
            $grid->model()->where(['deleted_at' => null]);
            $grid->column('id','序号')->sortable();
            $grid->column('tmp_name');
            $grid->column('call_name');
            $grid->column('tmp_content')->limit(50)->width(200);
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();
            });

            if (Admin::user()->can('configsmstmp-creat-form')) {
                $grid->enableDialogCreate();
            } else {
                $grid->disableCreateButton();
            }
            if (Admin::user()->can('configsmstmp-edit-form')) {
                $grid->showQuickEditButton();
            }
            if (!Admin::user()->can('configsmstmp-delete')) {
                $grid->disableDeleteButton();
            }
            $grid->disableEditButton();
            $grid->setDialogFormDimensions('70%', '90%');
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
        return Show::make($id, new ConfigSmsTmp(), function (Show $show) {
            $show->field('id');
            $show->field('tmp_name');
            $show->field('call_name');
            $show->field('tmp_content');
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
        return Form::make(new ConfigSmsTmp(), function (Form $form) {
            $form->display('id');
            $form->text('tmp_name');
            $form->text('call_name');
            $form->textarea('tmp_content');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
