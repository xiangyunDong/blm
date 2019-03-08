@extends('layout.app')
@section('contents')
    <h1>活动添加页面</h1>
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <script type="text/javascript" src="/webuploader/jquery.js"></script>
    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    @include('layout._errors')
    @include('vendor.ueditor.assets')
    <form class="form-group" method="post" action="{{route('events.store')}}" >
        <label>活动标题</label>
        <input class="form-control" type="text" name="title" value="{{old('title')}}">
        <label>内容</label>
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>
        <script id="container" name="content" type="text/plain"></script>
        <label>报名开始时间</label>
        <input type="date" class="form-control" name="signup_start" value="{{old('signup_start')}}">
        <label>报名结束时间</label>
        <input type="date" class="form-control" name="signup_end" value="{{old('signup_end')}}">
        <label>开奖日期</label>
        <input type="date" class="form-control" name="prize_date" value="{{old('prize_date')}}">
        <label>报名人数限制</label>
        <input type="text" class="form-control" name="signup_num" value="{{old('signup_num')}}">
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
            server:'shop_categories.upload',

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
    </script>
    @stop;