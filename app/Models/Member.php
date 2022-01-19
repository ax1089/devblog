<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'member';
    protected $fillable = ['username','user_avatar'];

}
