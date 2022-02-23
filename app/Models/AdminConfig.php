<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class AdminConfig extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'admin_config';

    public $timestamps = false;


    //配置类型[ 1 => '邮件'，2 => '短信'];
    public const GROUP_TYPE_OPTIONS = [
        1 => 'email',
        2 => 'sms',
    ];

    //邮件发送方式
    public const SEND_TYPE_OPTIONS = [
        1 => 'SMTP',
        2 => 'POP3',
    ];

    //验证方式
    public const VERY_TYPE_OPTIONS = [
        1 => 'SSL',
        2 => 'TTL',
    ];

    public static function getSms_Template(){

        $temp = self::select('sm_template')->first()->toArray();
       $res=json_decode($temp['sm_template'],true);
        $teparray=[];
        foreach ($res as $key=>$val){
            $teparray[$key+1]=$res[$key]['val'];
        }
        return $teparray;
    }

}
