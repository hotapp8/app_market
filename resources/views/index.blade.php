@extends('layouts.indexLayout')
@section('content')
    <!-- 轮播图-->
    <div class="container">
        <div class="row">
            <div class="col-md-12 carousel">
                <img style="width:100%;" src="{{ asset('images/lunbo.jpg') }}" alt="芝麻小程序市场"/>
                <button class="btn btn-issue" data-toggle="modal" data-target=".model-issue">发布小程序</button>
            </div>
        </div>
        <!-- 导航 -->
        <div class="zhima-nav">
            <div class="container">
                <div class="col-md-12  ">
                    <div class="content-left">
                        <ul>
                            <li class="active-left"><a href="">全部分类</a></li>
                            @foreach($tag as $taglist)
                                <li class=""><a class="taglist" data-id="{{$taglist->id}}"
                                                href="">{{$taglist->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- 展示页 -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 " style="padding:0;">
                    <ul class="content-right">
                    </ul>
                    <div class="morelist" style="cursor:pointer;">加载更多</div>
                </div>
            </div>
        </div>
        @endsection
        @section('script')
            <script>
                var offset = 0
                var limit = 12

                // ng
                function ajax(offset = 0, tag = null) {
                    $.ajax({
                        url: "{{url('ajax')}}",
                        method: 'POST',
                        data: {'offset': offset, 'limit': limit, 'tag': tag},
                        success: function (res) {
                            if (res.length != 0) {
                                $.each(res, function (index, value) {
                                    var li = $('<li class="code-item" data-item="' + value.id + '"></li>');
                                    var dl = $('<dl></dl>');
                                    var dd1 = $('<dd></dd>');
                                    var icon = '<img class="dataicon" src="' + value.icon + '" alt="正在加载中...">'
                                    var dd2 = $('<dt></dt>');
                                    var p = $('<p></p>');
                                    var name = '<span class="dataname">' + value.name + '</span>';
                                    var qrcode = '<button type="button" class="btn btn-taste" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="<img alt=\'qrcode\' class=\'img-responsive\' style=\'width:120px;height:150px;\' src=' + value.qrcode + '>">体验</button>';
                                    var overall_rating = $('<div class="overallrating"></div>');
                                    var star = $('<div class="star"></div>');
                                    var score = '<span class="score">' + value.overall_rating / 10 + '</span>分'

                                    var tag = $('<div class="btn-tag-list"></div>');
                                    var description = '<p class="description">' + value.description + '</p>';

                                    $.each(value.tag, function (index, value) {
                                        tag.append('<a data-id="' + index + '" type="button" class="btn btn-default btn-xs eachTag">' + value + '</a>');
                                    })

                                    li.append(dl);
                                    dl.append(dd1);
                                    dd1.append(icon);
                                    dl.append(dd2);
                                    dd2.append(p);
                                    p.append(name);
                                    p.append(qrcode);
                                    overall_rating.append(star);
                                    overall_rating.append(score);
                                    dd2.append(overall_rating);

                                    li.append(tag);
                                    li.append(description);

                                    $('.content-right').append(li);

                                    $(".star").eq(index).raty({readOnly: true, score: value.overall_rating / 10});
                                });
                                $("[data-toggle='tooltip']").tooltip();

                                // 分类跳转
                                $('.eachTag').on('click', function () {
                                    offset = 0
                                    $('.morelist').html('加载更多');
                                    $('.content-right').html('');
                                    tag = $(this).data('id');
                                    ajax(offset, tag);
                                    // 修改样式 todo
                                    $('.content-left li').attr('class', '');
                                    $(this).parent().attr('class', 'active-left');
                                    return false;
                                })

                                $('.code-item').on('click', function () {
                                    var item = $(this).data('item');
                                    window.open("{{url('show')}}/" + item);
                                })
                            } else {
                                // no more data
                                $('.morelist').html('没有更多了');
                            }

                        }
                    });
                }

                // 加载更多
                $('.morelist').on('click', function () {
                    offset += limit;
                    ajax(offset, !(typeof(tag) == 'undefined') ? tag : null);
                })

                // 发布小程序
                $('.btn-issue').on('click', function () {
                    if ("{{session('uid')}}") {
                        window.location = "{{url('create')}}";
                    } else {
                        alert('请登录');
                    }
                })

                // 分类跳转
                $('.taglist').on('click', function () {
                    offset = 0
                    $('.morelist').html('加载更多');
                    $('.content-right').html('');
                    tag = $(this).data('id');
                    ajax(offset, tag);
                    // 修改样式
                    $('.content-left li').attr('class', '');
                    $(this).parent().attr('class', 'active-left');
                    return false;
                })

                // main
                $(function () {
                    ajax(offset);
                });
            </script>
@endsection
