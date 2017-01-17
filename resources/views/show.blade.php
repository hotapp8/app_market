@extends('layouts.indexLayout')
@section('content')
    <!-- 头部 -->
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="show-top-left">
                    <dl>
                        <dt><img src="{{$market->icon}}" alt="icon"/></dt>
                        <dd>
                            <p class="market-name">
                                <b>{{$market->name}}</b>
                            </p>

                            <p>
                                <span class="star"></span>
                                <span class="score">{{ $market->overall_rating/ 10 }}</span>&nbsp;分

                            </p>
                            <p>作者：{{$nickname}}</p>
                        </dd>
                    </dl>
                    @if($is_admin)
                        <div class="pull-right">
                            <button class="btn btn-success" onclick="hot('{{ !$is_hot }}', '{{ $id }}');">
                                {{ $is_hot ? '取消' : '设为' }}热门
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="show-top-left">
                    <dl>
                        <dt><img src="{{$market->qrcode}}" alt=""/></dt>
                        <dd>
                            <p class="market-name"><b>微信扫描体验</b></p>
                            <p>发布时间：{{$market->create_time}}</p>
                            <p>要求：微信最新版本客户端，6.5.3 版本以上</p>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <!-- 内容 -->
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="show-content-left">
                    <h4>截图:</h4>
                    <div class="show-img-box">
                        <div class="show-img">
                            @foreach($screenshot as $screenshotlist)
                                <img src="{{$screenshotlist}}" alt=""/>
                            @endforeach
                        </div>
                    </div>

                    <h4>介绍: </h4>
                    <div class="show-description">
                        {{$market->description}}
                    </div>

                    <h4>评论: <span class="localstar"></span></h4>
                    <div class="show-comment-box">
                        <textarea id="subcontent" name="name" rows="8" cols="80"></textarea>
                        <a class="comment" href="###">发表评论</a>
                    </div>

                    <h4>评论列表：</h4>
                    <div class="commentlist">
                        @foreach($comment as $commentlist)
                            <dl>
                                <dt><img src="{{asset('images/imgheadtest.png')}}" alt=""/></dt>
                                <dd>
                                    <p>
                                        <span class="commentname">{{$commentlist->nickname}}</span>
                                        <span class="commentname"></span>
                                        <b class="commenttime">{{$commentlist->create_time}}</b>
                                    </p>

                                    <p class="commentcontent">{{$commentlist->content}}<p>
                                </dd>
                            </dl>
                        @endforeach
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <div class="show-content-right">
                    <ul>
                        <li><h5>热门小程序</h5></li>
                        @foreach($hot as $hotlist)
                            <li><a style="color:#999" href="{{url('show').'/'.$hotlist->id}}">
                                    <img class="hotimg" src="{{$hotlist->icon}}" alt=""/>
                                    <p>{{$hotlist->name}}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/jquery.raty.min.js') }}"></script>
    <script>
        //提交评论评分
        $('.localstar').raty({
            click: function (score, evt) {
                showObj.score = score
            }
        })
        //评分
        for (var i = 0; i < 18; i++) {
            $('.star').eq(i).raty({
                readOnly: true,
                score: $('.score').eq(i).text()
            });
        }
        //评论
        var showObj = {
            score: '',
            subcontent: ''
        }
        comment();
        function comment() {
            $('.comment').on('click', function () {
                showObj.subcontent = $('#subcontent').val()
                $('#star').raty({
                    click: function (score, evt) {
                        showObj.score = score
                    }
                });
                if (!showObj.subcontent && !showObj.score) {
                    console.log('请填写评论和评价！')
                } else {
                    if ("{{session('uid')}}") {
                        $.ajax({
                            url: "{{url('comment')}}",
                            method: 'POST',
                            data: {
                                rate: showObj.score,//评分
                                id: "{{$id}}",
                                content: showObj.subcontent
                            },
                            success: function (data) {
                                console.log(data)
                                if (data.res == 0) {
                                    console.log('评论成功');
                                    window.location.reload();
                                }
                            }
                        })
                    } else {
                        alert('请登录')
                    }
                }


            })

        }

        function hot(type, mid) {
            $.post("{{ url('hot') }}", {"type": type, "mid": mid}, function () {
                location.reload();
            })
        }
    </script>
@endsection
