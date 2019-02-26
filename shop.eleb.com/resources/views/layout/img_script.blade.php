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