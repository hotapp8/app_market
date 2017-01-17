<?php

/**
 * 芝麻小事网络科技（武汉）有限公司 版权所有
 * 首页必须有hotapp小程序统计的友情链接 http://weixin.hotapp.cn
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AppMarket;
use App\Models\AppHot;
use App\Models\AppUser;

class Manage extends Controller
{
    /**
     * Review the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function doReview(Request $request)
    {
        if (AppUser::where('id', session('uid'))->value('type') == 1) {
            // only type == 1 can access
            AppMarket::where('id', $request->get('id'))->update(['available' => $request->get('available')]);
        } else {
            redirect('/');
        }
    }

    /**
     * List resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function listReview()
    {
        if (AppUser::where('id', session('uid'))->value('type') == 1) {
            // only type == 1 can access
            $data = AppMarket::where('available', 0)->select(['id', 'name', 'create_time'])->paginate();

            return view('review', ['data' => $data]);
        } else {
            return redirect('/');
        }
    }

    /**
     * List resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function listHot()
    {
        if (AppUser::where('id', session('uid'))->value('type') == 1) {
            // only type == 1 can access
            $appHot = (new AppHot)->getTable();
            $appMarket = (new AppMarket)->getTable();
            $hot_data = AppMarket::where('available', 1)
                ->join($appHot, "{$appHot}.mid", '=', "{$appMarket}.id")
                ->select(["{$appMarket}.id", 'name', "{$appMarket}.create_time"])
                ->paginate();

            $data = AppMarket::where('available', 1)
                ->whereNotIn('id', AppHot::lists('mid'))
                ->select(['id', 'name', 'create_time'])
                ->paginate();

            return view('hot', ['hot_data' => $hot_data, 'data' => $data]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Deal the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function editHot(Request $request)
    {
        $mid = $request->get('mid');
        $type = $request->get('type');  // 1: insert, 0: delete

        if ($type) {
            AppHot::create(['mid' => $mid]);
        } else {
            AppHot::where('mid', $mid)->delete();
        }
    }
}
