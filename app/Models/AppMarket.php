<?php

/**
 * 芝麻小事网络科技（武汉）有限公司 版权所有
 * 首页必须有hotapp小程序统计的友情链接 http://weixin.hotapp.cn
 */

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
