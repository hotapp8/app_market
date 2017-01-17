<?php

/**
 * 芝麻小事网络科技（武汉）有限公司 版权所有
 * 首页必须有hotapp小程序统计的友情链接 http://weixin.hotapp.cn
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AppComment;
use App\Models\AppMarket;
use App\Models\AppUser;

class Comment extends Controller
{
    public function comment(Request $request)
    {
        $mid = $request->get('id');
        $overall_rating = AppMarket::where('id', $mid)->value('overall_rating');

        AppMarket::where('id', $mid)->update([
            'overall_rating' => ($overall_rating + $request->get('rate') * 10) / 2
        ]);

        AppComment::create([
            'mid'     => $mid,
            'uid'     => session('uid'),
            'rate'     => $request->get('rate') * 10,
            'content' => $request->get('content')
        ]);

        $appUser = (new AppUser)->getTable();
        $appComment = (new AppComment())->getTable();

        $comment = AppComment::join($appUser, "{$appUser}.id", '=', "{$appComment}.uid")
            ->where('mid', $mid)
            ->orderBy("{$appComment}.id", 'desc')
            ->get(['nickname', "{$appComment}.create_time", 'content', 'rate']);

        return response()->json(['res' => 0, 'msg' => '评论成功', 'data' => $comment]);
    }
}
