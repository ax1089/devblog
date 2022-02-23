<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ConfigSmsTmp extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'admin_config_sms_tmp';



}
