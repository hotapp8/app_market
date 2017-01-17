<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AppMarket;
use App\Models\AppTag;
use App\Models\AppTags;
use App\Models\AppScreenshot;
use App\Models\AppComment;
use App\Models\AppHot;
use App\Models\AppUser;

class Index extends Controller
{
    /**
     * Display index of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = AppTag::select(['id', 'name'])->get();

        return view('index', ['tag' => $tag]);
    }

    /**
     * Return some of the resource via Ajax.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax(Request $request)
    {
        $tagId = $request->get('tag');
        $offset = $request->get('offset', 0);
        // todo: optimize
        $limit = $request->get('limit', 12);

        if (empty($tagId)) {
            $data = AppMarket::select([
                'id', 'name', 'qrcode', 'description', 'icon', 'overall_rating'
            ])
                ->where('available', 1)
                ->orderBy('id', 'desc')
                ->offset($offset)
                ->limit($limit)
                ->get();
        } else {
            if ($tagId == 'hot') {
                // tbl_app_hot
                $mid = AppHot::lists('mid');
            } else {
                // tbl_app_tags
                $mid = AppTags::where('tid', $tagId)->lists('mid');
            }
            $data = AppMarket::whereIn('id', $mid)
                ->select([
                    'id', 'name', 'qrcode', 'description', 'icon', 'overall_rating'
                ])
                ->where('available', 1)
                ->orderBy('id', 'desc')
                ->offset($offset)
                ->limit($limit)
                ->get();

            // $appMarket = (new AppMarket)->getTable();
            // $appTags = (new AppTags)->getTable();
            // $appTag = (new AppTag)->getTable();
            // $t = AppMarket::join($appTags, "{$appTags}.mid", '=', "{$appMarket}.id")
            //     // ->join($appTag, "{$appTag}.id", '=', "{$appTags}.tid")
            //     ->where('tid', $tagId)
            //     ->groupBy('tbl_app_tags.mid')
            //     ->get();
            //
            // dd($t->toArray());
        }

        foreach ($data as $each) {
            // todo: optimize
            $tid = AppTags::where('mid', $each->id)->lists('tid');
            $each->tag = AppTag::whereIn('id', $tid)->lists('name', 'id');
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = AppTag::all();

        return view('create', ['tag' => $tag]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('name')) {
            $market['name'] = $request->get('name');
        }

        if ($request->has('qrcode')) {
            $market['qrcode'] = $request->get('qrcode');
        }

        if ($request->has('url')) {
            $market['url'] = $request->get('url');
        }

        if ($request->has('description')) {
            $market['description'] = $request->get('description');
        }

        if ($request->has('icon')) {
            $market['icon'] = $request->get('icon');
        }

        $mid = AppMarket::create($market)->id;

        if ($request->has('tag')) {
            if (count($request->get('tag')) > 5) {
                return response()->json(['res' => 1, 'msg' => 'tag 不能超过 5 个']);
            }

            foreach ($request->get('tag') as $key => $value) {
                $tags[$key]['tid'] = $value;
                $tags[$key]['mid'] = $mid;
                $tags[$key]['create_time'] = time();
                $tags[$key]['update_time'] = time();
            }
            AppTags::insert($tags);
        }

        if ($request->has('screenshot')) {
            if (count($request->get('screenshot')) > 5) {
                return response()->json(['res' => 1, 'msg' => '截图不能超过 5 张']);
            }
            foreach ($request->get('screenshot') as $key => $value) {
                $screenshot[$key]['image'] = $value;
                $screenshot[$key]['mid'] = $mid;
                $screenshot[$key]['create_time'] = time();
                $screenshot[$key]['update_time'] = time();
            }
            AppScreenshot::insert($screenshot);
        }

        return response()->json(['res' => 0, 'msg' => '创建成功']);
    }

    /**
     * Image upload
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $key => $value) {
                if (substr($value->getMimeType(), 0, 5) == 'image') {
                    $image['image'][$key] = '/upload/' . date('Ymd') . '/' . md5(str_random(32)) . '.jpg';
                    $value->move('upload/' . date('Ymd'), $image['image'][$key]);
                    $image['res'] = 0;
                    $image['msg'] = '上传成功';
                } else {
                    $image = ['res' => 1, 'msg' => '不支持的格式'];
                }
            }
        } else {
            $image = [];
        }

        return response()->json($image);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $is_admin = AppUser::where('id', session('uid'))->value('type') === 1 ? true : false;

        if ($is_admin) {
            // only admin can access NOT reviewed app
            $market = AppMarket::where("id", $id)
                ->select(['id', 'uid', 'name', 'qrcode', 'url', 'description', 'icon', 'overall_rating', 'create_time'])
                ->first();
        } else {
            $market = AppMarket::where("id", $id)
                ->where('available', 1)
                ->select(['id', 'uid', 'name', 'qrcode', 'url', 'description', 'icon', 'overall_rating', 'create_time'])
                ->first();
        }

        if (is_null($market)) {
            return redirect('/');
        }

        $tid = AppTags::where('mid', $market->id)->lists('tid');
        $market->tag = AppTag::whereIn('id', $tid)->lists('name');

        $screenshot = AppScreenshot::where('mid', $id)->lists('image');

        $appUser = (new AppUser)->getTable();
        $appComment = (new AppComment())->getTable();

        $comment = AppComment::join($appUser, "{$appUser}.id", '=', "{$appComment}.uid")
            ->where('mid', $id)
            ->orderBy("{$appComment}.id", 'desc')
            ->get(['nickname', "{$appComment}.create_time", 'content', 'rate']);

        $appMarket = (new AppMarket)->getTable();
        $appHot = (new AppHot())->getTable();
        $hot = AppHot::join($appMarket, "{$appMarket}.id", '=', "{$appHot}.mid")
            ->where('available', 1)
            ->select(["{$appMarket}.id", 'name', 'icon'])
            ->get();

        $nickname = AppUser::where('id', $market->uid)->value('nickname');

        $is_hot = is_null(AppHot::where('mid', $id)->first()) ? 0 : 1;

        return view('show', [
            'market'     => $market,
            'screenshot' => $screenshot,
            'comment'    => $comment,
            'hot'        => $hot,
            'nickname'   => $nickname,
            'id'         => $id,
            'is_admin'   => $is_admin,
            'is_hot'     => $is_hot
        ]);

    }
}
