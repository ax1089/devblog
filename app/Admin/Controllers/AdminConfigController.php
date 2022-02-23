<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\SetConfig;
use App\Admin\Actions\Grid\SetCourse;
use App\Admin\Renderable\CourseOutlieTable;
use App\Models\AdminConfig;
use App\Models\Course;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class AdminConfigController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new AdminConfig(), function (Grid $grid) {
            $grid->addTableClass(['table-text-center']);
            $grid->model()->where(['deleted_at' => null]);
            $grid->column('id', '序号')->sortable();
            $grid->column('title');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });

            if (Admin::user()->can('adminconfig-creat-form')) {
                $grid->enableDialogCreate();
            } else {
                $grid->disableCreateButton();
            }
            if (Admin::user()->can('adminconfig-edit-form')) {
                $grid->showQuickEditButton();
            }
            if (!Admin::user()->can('adminconfige-delete')) {
                $grid->disableDeleteButton();
            }
            $grid->disableEditButton();
            // 禁用
            $grid->disableCreateButton();
            // 禁用
            $grid->disableRowSelector();
            // 禁用
            $grid->disableToolbar();
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();
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
        return Show::make($id, new AdminConfig(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('setting_type','配置类型');
//            $show->field('value');
//            $show->field('rule');
            $show->field('tip');
            $show->field('content');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new AdminConfig(), function (Form $form) {
            $form->text('title', '配置名称');
            $form->radio('setting_type')
                ->when([1, 4], function (Form $form) {
                    $form->select('mailsend_type','邮件服务器')
                        ->options(AdminConfig::SEND_TYPE_OPTIONS)
                        ->config('allowClear', false)
                        ->config('minimumResultsForSearch', -1)
                        ->required();
                    $form->text('mailsend_server', '邮件服务器');

                    $form->text('mailsend_port', '通用端口');
                    $form->text('mailsend_username', '用户名');
                    $form->text('mailsend_password', '密码');
                    $form->select('mailsend_ttl','验证方式')
                        ->options(AdminConfig::VERY_TYPE_OPTIONS)
                        ->config('allowClear', false)
                        ->config('minimumResultsForSearch', -1)
                        ->required();
                    $form->text('mail_from', '发件人邮箱');
                })
                ->when(2, function (Form $form) {
                    $form->text('sm_app_key', '应用key');
                    $form->text('sm_app_secret', '应用秘钥secret');
                    $form->text('sm_sign', '签名');
                })
                ->options(AdminConfig::GROUP_TYPE_OPTIONS)
                ->default(1);
        });
    }
}
