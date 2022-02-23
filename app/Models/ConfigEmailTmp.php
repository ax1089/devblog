<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ConfigEmailTmp extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'admin_config_email_tmp';

    //邮件发送方式
    public const TMP_TYPE_OPTIONS = [
        1 => '课前通知',
        2 => '课后通知',
    ];

}
