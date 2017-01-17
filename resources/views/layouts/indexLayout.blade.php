<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="小程序二维码商店，精品小程序二维码下载，可免费提交小程序到应用商店
"/>
    <meta name="keywords" content="小程序二维码,小程序应用商店，小程序市场，芝麻小程序，小程序提交"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge"/>
    <meta name="renderer" content="webkit">
    <meta content="email=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">

    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/show.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}"/>
    <title>芝麻小程序市场</title>
</head>
<body>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1>芝麻小程序市场</h1>
                <a href="{{url('/')}}"><img src="{{ asset('images/zhima.png') }}" alt="芝麻小程序市场"></a>
                <a style="margin-left:20px;color:#666" href="https://weixin.hotapp.cn">HotApp小程序统计</a>
            </div>

            <div class="col-md-3 hidden-xs hidden-sm" style="text-align:right">
                <!-- 登录 -->
                @if(session('uid'))
                    <a type="button" class="btn btn-login" href="{{ url('logout') }}">退出</a>
                @else
                    <button type="button" class="btn btn-login" data-toggle="modal" data-target="#model-login">登录
                    </button>
                    <!-- 注册 -->
                    <button type="button" class="btn btn-reg" data-toggle="modal" data-target="#model-register">注册
                    </button>
                @endif

            </div>
        </div>
    </div>
</div>
<!-- 内容页 -->
@yield('content')


<div class="footer-box">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div style="text-align: center;">
                    <p>芝麻小事网络科技（武汉）有限公司 鄂ICP备16019105号 ©版权所有</p>
                    <p><a href="{{ url('review') }}" target="_blank">管理后台</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 用户注册 end-->
<div class="modal fade" id="model-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel"> 用户注册 </h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">

                    <div class="form-group">
                        <label class="control-label col-sm-3">昵称：<span style="color: red;"> * </span></label>
                        <div class="col-sm-8">
                            <input type="input" id="nickname" placeholder="请输入您的昵称" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-3">手机号 <span style="color: red;"> * </span></label>
                        <div class="col-sm-8">
                            <input type="input" id="phoneNo" placeholder="请输入您的手机号" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">密码 <span style="color: red;"> * </span></label>
                        <div class="col-sm-8">
                            <input type="password" id="password" placeholder="至少6位" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">重复密码 <span style="color: red;"> * </span></label>
                        <div class="col-sm-8">
                            <input type="password" id="repassword" placeholder="重复输入密码" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group" style="margin: 0 0 0 0;">
                        <div class="col-sm-11 text-right">
                            <a href="javascript:;" data-toggle="modal" data-target="#model-login" data-dismiss="modal"
                               class="" style="font-size: 12px;">
                                登&nbsp;&nbsp;&nbsp;&nbsp;录
                            </a>
                        </div>
                    </div>
                    <div class="control">
                        <div id="reg-error" name="reg-error" class="alert alert-danger " hidden="true"
                             align="middle"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="regbtn" name="regbtn" onclick="regBtnOnClick()" class="btn btn-primary">注册
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<!-- 用户注册 end-->

<!-- 用户登录-->
<div class="modal fade" id="model-login" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">用户登录 </h4>
            </div>
            <div class="modal-body">
                <div class=" form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">账号：</label>
                        <div class="col-sm-9">
                            <input type="input" id="login_username" placeholder="请输入您的账号(如手机号或邮箱)"
                                   class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">密码：</label>
                        <div class="col-sm-9">
                            <input type="password" id="login_password" placeholder="您的密码" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-11 text-right">
                            <a href="javascript:;" data-toggle="modal" data-target="#model-register"
                               data-dismiss="modal" class="text-danger " style="font-size: 12px;">
                                注&nbsp;&nbsp;&nbsp;&nbsp;册
                            </a>


                        </div>
                        <div class="form-group">
                            <div id="login-error" name="login-error"
                                 class="alert alert-danger col-sm-10 col-sm-offset-1" hidden="true"
                                 align="middle"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="loginbtn" name="loginbtn" onclick="loginBtnOnClick()"
                            class="btn btn-user-login">登录
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 用户登录 end-->
<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdn.bootcss.com/blueimp-md5/2.6.0/js/md5.js"></script>
<script src="{{ asset('js/jquery.raty.min.js') }}"></script>
@yield('script')
<script>
    $('.btn-quit').on('click', function () {
        window.location.reload();
    })
    //-----------登陆-------------//
    function loginBtnOnClick() {
        var $btn = $("#loginbtn");
        var username = $("#login_username").val();
        var password = $("#login_password").val();


        $btn.button('loading');
        if (username == "" || password == "") {
            $("#login-error").html("账户或者密码不为空");
            $("#login-error").show();
            $btn.button('reset');
            return;
        }

        $.post("{{url('login')}}", {
                'phone': username,
                'password': md5(password),
                '_token': "{{ csrf_token() }}"
            },
            function (data) {
                $btn.button('reset');
                if (data.res == 0) {
                    location.reload();
                } else {
                    $("#login-error").html(data.msg);
                    $("#login-error").show();
                }
            }, "json");
        return;
    }
    ;


    ////----------注册-----------////
    function regBtnOnClick() {
        var $btn = $("#regbtn");
        $btn.button('loading');
        var username = $("#phoneNo").val();
        var nickname = $("#nickname").val();
        var password = $("#password").val();
        var re_password = $("#repassword").val();

        if (username == "") {
            $("#reg-error").html("手机号不能为空");
            $("#reg-error").show();
            $btn.button('reset');
            return;
        }

        if (!isMobile(username)) {
            $("#reg-error").html("手机号码格式错误");
            $("#reg-error").show();
            $btn.button('reset');
            return;
        }
        if (password == "") {
            $("#reg-error").html("密码不能为空");
            $("#reg-error").show();
            $btn.button('reset');
            return;
        }
        if (password != re_password) {
            $("#reg-error").html("两次输入的密码不一致");
            $("#reg-error").show();
            $btn.button('reset');
            return;
        }

        $.post("{{url('register')}}", {
                'nickname': nickname,
                'phone': username,
                'password': md5(password),
                '_token': "{{ csrf_token() }}"
            },
            function (data) {
                $btn.button('reset');
                if (data.res == 0) {
                    location.reload();
                } else {
                    $("#reg-error").html(data.msg);
                    $("#reg-error").show();
                }
            }, "json");
        return;
    }

    //--------校验手机号码的正则------------////
    function isMobile(str) {
        var patrn = /^1[1|2|3|4|5|6|7|8|9][0-9]\d{8}$/;
        return patrn.test(str);
    }
</script>
</body>
</html>
