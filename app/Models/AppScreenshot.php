<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppScreenshot extends Model
{
    protected $table = 'tbl_app_screenshot';

    protected $fillable = ['mid', 'image'];

    protected $dateFormat = 'U';

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';
}
