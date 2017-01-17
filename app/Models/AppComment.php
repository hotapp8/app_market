<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppComment extends Model
{
    protected $table = 'tbl_app_comment';

    protected $fillable = ['mid', 'uid', 'rate', 'content'];

    protected $dateFormat = 'U';

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';
}
