@extends('layouts.indexLayout')
@section('content')

    <div class="container">
        <div class="row">
            <h3 style="text-align:center">发布小程序</h3>
            <div class="col-md-3">
                <div class="create-left">
                    <form>
                        <label for="name"><span>*</span>小程序名称:</label>
                        <label for="qrcode"><span>*</span>小程序二维码:</label>
                        <!-- <label for="url"><span>*</span>小程序 URL (选填):</label> -->
                        <label for="description"><span>*</span>产品描述:</label>
                        <label for="tag" class="center-block"><span>*</span>添加标签 (最多可选择五个):</label>
                        <label for="qrcode"><span>*</span>产品 ICON&nbsp;:

                        </label>
                        <label for="qrcode"><span>*</span>产品截图&nbsp;:
                            <small>（最多不超过五张）</small>
                        </label>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="create-right">
                    <form id="createform" enctype="multipart/form-data">
                        <input type="text" class="form-control" name="name" id="name" placeholder="请输入小程序名称">
                        <div class="qrcodegroup">
                            <div class="qrcodeimgall">
                                <img class="qrcodeimg" src="{{asset('images/addimg.png')}}" alt=""/>
                            </div>
                            <input type="hidden" name="qrcode" value="">
                            <input type="file" class="qrcode" id="qrcode">
                            <small style="height:80;line-height:80px;margin-left:20px;">建议尺寸：不小于 400×400px，并且为正方形
                            </small>
                        </div>

                        <!-- <input type="text" class="form-control" name="url" id="url" placeholder="请输入有效的网址"> -->
                        <textarea class="form-control" rows="3" name="description" id="description"
                                  placeholder="请输入产品描述"></textarea>
                        <div class="tagbox">
                            @foreach($tag as $eachTag)
                                <label class="addcheckbox">
                                    {{ $eachTag->name }}
                                    <input class="checkedtag" type="checkbox" name="tag[]" value="{{ $eachTag->id }}">
                                </label>
                            @endforeach
                        </div>
                        <div class="qrcodegroup" style="margin:20px 0">
                            <div class="qrcodeiconall">
                                <img src="{{asset('images/addimg.png')}}" alt=""/>
                            </div>
                            <input type="hidden" name="icon" value="">
                            <input type="file" class="qrcode" id="qrcodeicon">
                            <small style="height:80;line-height:80px;margin-left:20px;">建议尺寸：不小于 400×400px，并且为正方形
                            </small>
                        </div>
                        <div class="qrcodegroup">
                            <div class="screenshotall">
                                <img src="{{asset('images/addimg2.png')}}" alt=""/>
                            </div>
                            <input type="hidden" name="screenshot[]" value="">
                            <input type="file" class="qrcode2" multiple="multiple" id="screenshot">
                        </div>
                        {!! csrf_field() !!}
                        <div class="addsub">
                            <button type="submit" class="btn btn-save">保存并上传</button>
                            <button type="submit" class="btn btn-exit">取消</button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-md-3">
            </div>
        </div>

    </div>

@endsection




@section('script')
    <script>
        $('.addcheckbox').on('click', function () {
            if ($('input[name="tag[]"]:checked').length > 5) {
                console.log($('input[name="tag[]"]:checked').length)
                alert('不能超过5个')
                return false;
            } else {
                $('input[name="tag[]"]:checked').parent().addClass('checkedgreen')
                $('input[name="tag[]"]').not("input:checked").parent().removeClass('checkedgreen')
            }

        })

        $('.btn-save').on('click', function () {
            $.ajax({
                cache: true,
                type: "POST",
                url: "{{url('create')}}",
                data: $('#createform').serialize(),// 你的formid
                async: false,
                success: function (data) {
                    //  alert(data.msg)
                    window.location = "{{url('/')}}"
                }
            });
        })


        uploadimg('#qrcode', 'qrcode', '.qrcodeimgall');
        uploadimg('#qrcodeicon', 'icon', '.qrcodeiconall');
        uploadimg('#screenshot', 'screenshot[]', '.screenshotall');

        function uploadimg(data, dataname, dataimg) {
            $(data).on('change', function () {
                var sum = $(data)[0].files.length
                var formData = new FormData();
                for (var i = 0; i < sum; i++) {
                    formData.append('image[]', $(data)[0].files[i]);
                }
                $.ajax({
                    url: '{{url("uploadImage")}}',
                    type: 'POST',
                    cache: false,
                    data: formData,
                    processData: false,
                    contentType: false
                }).done(function (res) {
                    $(dataimg).html('')
                    for (var i = 0; i < res.image.length; i++) {
                        if (data == "#screenshot") {
                            $(dataimg).append('<img style="height:245px;width:155px" src="' + res.image[i] + '" alt="" />')

                        } else {
                            $(dataimg).append('<img style="height:80px;width:80px" src="' + res.image[i] + '" alt="" />')
                            $("input[name=" + dataname + "]").val(res.image[i])
                        }

                    }
                }).fail(function (res) {
                    console.log(res)
                });
            })
        }


    </script>
@endsection
