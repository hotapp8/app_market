<?php

/**
 * 芝麻小事网络科技（武汉）有限公司 版权所有
 * 首页必须有hotapp小程序统计的友情链接 http://weixin.hotapp.cn
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AppUser;

class User extends Controller
{
    /**
     * Login action
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $uid = AppUser::where([
            'phone'    => $request->get('phone'),
            'password' => $request->get('password')
        ])->value('id');

        if ($uid) {
            session(['uid' => $uid]);
            $data = ['res' => 0, 'msg' => '登录成功'];
        } else {
            $data = ['res' => 1, 'msg' => '手机号或密码错误'];
        }

        return response()->json($data);
    }

    /**
     * Reg action
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $res = (new AppUser)->firstOrCreate(['phone' => $request->get('phone')], $request->all());

        session(['uid' => $res->id]);

        if ($res->wasRecentlyCreated) {
            $data = ['res' => 0, 'msg' => '注册成功'];
        } else {
            $data = ['res' => 1, 'msg' => '用户已存在'];
        }

        return response()->json($data);
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        session(['uid' => null]);

        return redirect('/');
    }
}
