<?php

namespace App\Admin\Controllers;

use App\Admin\Renderable\ConfigEmailTmpContentView;
use App\Admin\Renderable\ConfigMailFiles;
use App\Models\ConfigEmailTmp;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ConfigEmailTmpController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ConfigEmailTmp(), function (Grid $grid) {
            $grid->addTableClass(['table-text-center']);
            $grid->model()->where(['deleted_at' => null]);
            $grid->column('id', '序号')->sortable();
            $grid->column('mail_title');
            $grid->column('mail_content')->display(function () {
                return $this->mail_content ? '点击查看' : '/';
            })->modal(function ($modal) {
                $modal->title('邮件模块内容');
                if (!$this->mail_content) {
                    $modal->icon('');
                    return '<p style="text-align: center"><i class="feather icon-alert-circle"></i> 暂无数据</p>';
                } else {
                    return '<div>' . $this->mail_content . '</div>';
                }
            });
            $grid->column('mail_type', '类型')->display(function () {
                if (isset(ConfigEmailTmp::TMP_TYPE_OPTIONS[$this->mail_type])) {
                    return ConfigEmailTmp::TMP_TYPE_OPTIONS[$this->mail_type];
                }
            });
            $grid->column('mail_append_url')->display(function () {
                return $this->mail_append_url ? '点击查看' : '/';
            })->modal(function (Grid\Displayers\Modal $modal) {
                $modal->title('附件文件');
                if (!$this->mail_append_url) {
                    $modal->icon('');
                }
                return ConfigMailFiles::make(['id' => $this->id]);
            });
            $grid->column('created_at');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();
            });

            if (Admin::user()->can('configemailtmp-creat-form')) {
                $grid->enableDialogCreate();
            } else {
                $grid->disableCreateButton();
            }
            if (Admin::user()->can('configemailtmp-edit-form')) {
                $grid->showQuickEditButton();
            }
            if (!Admin::user()->can('configemailtmp-delete')) {
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
        return Show::make($id, new ConfigEmailTmp(), function (Show $show) {
            $show->field('id');
            $show->column('mail_title');
            $show->editor('mail_content');
            $show->field('mail_type');
            $show->field('mail_call_name');
            $show->field('mail_append_url');
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
        return Form::make(new ConfigEmailTmp(), function (Form $form) {
            $form->display('id');
            $form->text('mail_title');
            $form->editor('mail_content');
            $form->select('mail_type', '模板类型')
                ->config('allowClear', false)
                ->config('minimumResultsForSearch', -1)
                ->options(ConfigEmailTmp::TMP_TYPE_OPTIONS)
                ->saving(function ($value) {
                    return $value ?? 0;
                });
            $form->text('mail_call_name');
            $form->multipleFile('mail_append_url', '附件上传')
                ->accept('pdf,docx,doc')
                ->move('/mail/' . date('Ym'))
                ->autoUpload()
                ->help('目前支持pdf、docx、doc格式文件上传')
                ->saving(function ($value) {
                    return $value ? json_encode($value) : null;
                });
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
