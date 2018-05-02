<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"C:\wamp\www\potato\public/../application/index\view\offices\addofficer.html";i:1525236612;s:58:"C:\wamp\www\potato\application\index\view\public\head.html";i:1525227111;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    
<meta charset="UTF-8">
<title>土豆日程管理</title>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
<meta http-equiv="Cache-Control" content="no-siteapp" />

<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="/potato/public/static/css/font.css">
<link rel="stylesheet" href="/potato/public/static/css/xadmin.css">
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="/potato/public/static/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/potato/public/static/js/xadmin.js"></script>

    <![endif]-->
</head>

<body>
<div class="x-body">
    <form class="layui-form" method="post" action="<?php echo url('add'); ?>">
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>姓名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="username" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="wid" class="layui-form-label">
                <span class="x-red">*</span>微信名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="wid" name="wid" required=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" type="submit" lay-filter="add">
                增加
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
                ,layer = layui.layer;

        //监听提交


/*        $("#addbtn").click(function(){
            $.ajax({
                type:'POST',
                url:"<?php echo url('add'); ?>",
                data: $(".layui-form").serialize(),
                dataType:"json",
                success:function(data){
                    if(data.iscorrect){
                        alert("添加成功");
                    }
                    else {
                        alert("添加失败");
                    }
                },
                error:function(){
                    alert("无法添加");
                }

            })
        })*/


    });
</script>
<
</body>

</html>