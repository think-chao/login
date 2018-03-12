<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Request;
use app\admin\model\Admin;
use think\Session;

class Login extends Base
{
#   渲染登录页面
    public function index()
    {
        $this->alreadylogin();
        return $this->fetch("login");
    }

    #检查登录
    //获取表单数据我们要用到request对象
    public function check(Request $request)
    {
        //设置返回值初始为0
        $status=0;
        //获取表单的数据，并保存到变量中
        //其返回结果是一个数组（“用户名，密码”）
        $data=$request->param();
        $userName=$data['username'];
        $password=md5($data['password']);

        //在admin表中查询,以用户名为条件
        //将查询条件放到一个数组中
        $map=['username'=>$userName];
        //将查询到的数据放到一个变量里头
        $admin=Admin::get($map);

        //用户名和密码分开验证
        if(is_null($admin)){
            $message="用户名不正确";
        }elseif($admin -> password !=$password){
            $message="密码不正确";
        }else{
            $status=1;
            $message="正在登录中,请点击确认";
            $admin -> setInc('login_count');
            $admin -> save(['last_time'=> time()]);

            Session::set('user',$userName);
            Session::set('psw',$password);
            Session::set('info',$admin->toArray());
        }

        return ['status'=>$status,'message'=>$message];

    }

#   退出登录
    public function out()
    {
        Session::delete('user');
        Session::delete('psw');
        $this->success("注销成功", 'login/index');
        //
    }


}
