<?php
namespace app\index\controller;
use app\index\controller\Base;
use think\Cookie;
use think\Session;
use app\index\model\admin;
use think\Db;
use think\Request;

class index extends Base
{
    public function index()
    {
        return $this->fetch("login");
    }
    public function check()
    {
        //获取一下表单提交的数据,并保存在变量中
        $username = $this->request->post("username");
        $password = $this->request->post("password");
       /* $captcha = $this->request->post("captcha");

        if(!captcha_check($captcha)){
            // 验证码错误
            // return $this->ret["captchaError"];
             $this->error("验证码错误");
        }*/

        $select = Db::query("select *from admin where username='$username' and password=md5('$password')"); // 执行查询
        // 获取信息对象
        if($select){
            Session::set("username",$username);
            Cookie::set("username",$username);
            $this->redirect('home/index');
        }else{
            $this->error('用户名或密码错误');
        }


    }
    public function logout(){
        // 清除session
        Session::delete('username');
        // 跳转到login页面
        $this->redirect('index');
    }

}
