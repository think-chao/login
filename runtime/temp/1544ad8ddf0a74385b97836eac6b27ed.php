<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"C:\wamp\www\potato\public/../application/index\view\leaders\leaderlist.html";i:1525236770;s:58:"C:\wamp\www\potato\application\index\view\public\head.html";i:1525227111;}*/ ?>
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

</head>

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
            <cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">

    <xblock>
        <button class="layui-btn" onclick="x_admin_show('添加用户','addleader')"><i class="layui-icon"></i>添加</button>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>

            <th>ID</th>
            <th>姓名</th>
            <th>微信名</th>
        </thead>
        <tbody>
        <tr>

            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $k=>$id): ?>
        <tr>
            <td><?php echo $data["$k"]['id']; ?></td>
            <td class="blue"><?php echo $data["$k"]['username']; ?></td>
            <td class="blue"><?php echo $data["$k"]['wid']; ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>

        </tr>
        </tbody>
    </table>

</div>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });



</script>

</body>

</html>