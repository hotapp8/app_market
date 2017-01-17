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
    <title>芝麻小程序市场</title>
</head>
<body>
<div class="container">
    <ul class="nav nav-tabs">
        <li id="review"><a href="{{ url('review') }}">审核</a></li>
        <li id="hot"><a href="{{ url('hot') }}">热门</a></li>
    </ul>
    @yield('content')
</div>


<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $("#{{ $active }}").attr('class', 'active');
</script>
@yield('script')
</body>
</html>
