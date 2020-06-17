<link rel="stylesheet" type="text/css" href="<?php echo urldecode(Url::urlFormat("@static/vendors/webuploader/webuploader.css"));?>">
<script type="text/javascript" src="<?php echo urldecode(Url::urlFormat("@static/vendors/webuploader/webuploader.min.js"));?>"></script>
<style type="text/css">
    .headpic img {width: <?php echo isset($width)?$width:"";?>px;height:<?php echo isset($height)?$height:"";?>px;} 
    .webuploader-pick {    width: 60px;
    background: url(<?php echo urldecode(Url::urlFormat("@static/images/addimg.png"));?>) no-repeat;    background-size: 60%;
    background-position: 12px;
    height: 60px;
    border: 1px solid #ccc;
    color: #ccc;
    line-height: 60px;
    padding: 0px;
    font-size: 36px;
    
    }
</style>
<input type="hidden" name="<?php echo isset($imgname)?$imgname:"";?>" id="images" value="<?php echo isset($images)?$images:"";?>">
<div class="headpic">
    <img src="<?php echo isset($images)?$images:"";?>" id="headpic_img">
    <span id="imagePicker" title="<?php echo isset($title)?$title:"";?>"></span>
</div>


<script type="text/javascript">
    $(function(){
        var uploader = WebUploader.create({
            auto: true,
            fileVal:'imgFile',
            fileNumLimit:10,
            swf: '<?php echo urldecode(Url::urlFormat("@static/vendors/webuploader/Uploader.swf"));?>',
            server: '<?php echo urldecode(Url::urlFormat("/index/upload_headpic"));?>',
            pick: '#imagePicker',
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/jpg,image/jpeg,image/png'
            },
            method: 'POST'
        });

        uploader.on( 'uploadSuccess', function( file , ret ) {
            
            $("#headpic_img").attr( 'src', ret.img );
            $('#images').val(ret.img);
        });

        uploader.on("uploadAccept", function( file, data){
            if (data.error == undefined) {
                return true;
            }else{
                return false;
            }
        });

        uploader.on( 'uploadError', function( file ) {
            swal('对不起，图片上传失败！');
        });
    
    });
</script>
 <!-- Powered by baxgsun@163.com -->