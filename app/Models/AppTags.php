<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppTags extends Model
{
    protected $table = 'tbl_app_tags';

    protected $fillable = ['mid', 'tid'];

    protected $dateFormat = 'U';

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';
}
