<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"C:\wamp\www\potato\public/../application/index\view\index\login.html";i:1525219300;}*/ ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Potato 日程管理</title>
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
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message">x-admin2.0-管理登录</div>
        <div id="darkbannerwrap"></div>
        
        <form method="post" class="layui-form" action="<?php echo url('index/check'); ?>" >
            <input id="username" name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input id="password" name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input id="captcha" name="captcha" lay-verify="required" placeholder="请输入验证码" class="layui-input">
            <span class="code_pic"><img align="center" src="<?php echo captcha_src(); ?>" alt="captcha" onclick="this.src='<?php echo captcha_src(); ?>'"/></span>
            <hr class="hr15">
            <input value="登录" id="loginbtn" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>


</body>
</html>