<?php

namespace App\Admin\Renderable;


use App\Models\ConfigEmailTmp;
use App\Models\Handout;
use Dcat\Admin\Support\LazyRenderable;
use Dcat\Admin\Widgets\Table;

class ConfigMailFiles extends LazyRenderable
{
    public function render()
    {
        $data = [];
        $id = $this->id;

        $fake = ConfigEmailTmp::find($id);

        if ($fake->mail_append_url) {
            $files = json_decode($fake->mail_append_url, true);
            foreach ($files as $v) {
                $fileName = explode('/', $v);
                $data[] = [
                    $fileName[count($fileName) - 1],
                    '<a href="' . '/uploads' . $v . '" download target="_blank">点击下载</a>'
                ];
            }
        }
        if ($data) {
            return Table::make(['附件件名称', '下载链接'], $data);
        } else {
            return '<p style="text-align: center"><i class="feather icon-alert-circle"></i> 暂无数据</p>';
        }
    }
}
