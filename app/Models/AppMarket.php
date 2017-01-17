<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppMarket extends Model
{
    protected $table = 'tbl_app_market';

    protected $fillable = ['uid', 'name', 'qrcode', 'url', 'description', 'icon', 'likes', 'shares', 'overall_rating', 'available'];

    protected $dateFormat = 'U';

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';
}
