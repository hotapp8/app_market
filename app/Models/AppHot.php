<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppHot extends Model
{
    protected $table = 'tbl_app_hot';

    protected $fillable = ['mid'];

    protected $dateFormat = 'U';

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';
}
