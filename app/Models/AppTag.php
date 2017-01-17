<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppTag extends Model
{
    protected $table = 'tbl_app_tag';

    protected $fillable = ['name'];

    protected $dateFormat = 'U';

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';
}
