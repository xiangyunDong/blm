@extends('layout.app')
@section('contents')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <script type="text/javascript" src="/webuploader/jquery.js"></script>
    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <h1>商家分类添加页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('shop_categories.store')}}" enctype="multipart/form-data">
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{old('name')}}">
        <label>图片</label>
        <input type="hidden" name="img" id="img_val">
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
            <td><img id="img" width="50" name="img"></td>
        </div>

        <label>状态</label>
        <div class="form-control">
        <input  type="radio" name="status" value="1">显示
        <input  type="radio" name="status" value="0">隐藏
        </div>
        {{csrf_field()}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    <script>
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            //swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: '/upload',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData:{
                _token:'{{csrf_token()}}',
            }
        });
        uploader.on( 'uploadSuccess', function(file,response) {
            // do some things.
            console.log(response.path);
            $("#img").attr('src',response.path);
            $("#img_val").val(response.path);
        });
    </script>
    @stop;