<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 2018/5/2
 * Time: 9:12
 */
namespace app\index\controller;
use app\index\controller\Base;
use think\Cookie;
use think\Session;
use app\index\model\admin;
use app\index\model\leader;
use think\Db;
use think\Request;
class leaders extends Base{
    public function leaderlist(){
        $data=db("leader")->select();
        $this->assign("data",$data);
        return $this->fetch();
    }

    public function addleader(){
        return $this->fetch();
    }

    public function add(){
        $username = $this->request->post('username');
        $wid = $this->request->post('wid');
        $data=['username'=>$username,'wid'=>$wid];
        $res=Db::table('leader')->insert($data);
        if($res)
            $this->redirect('leaders/leaderlist');
        else
            $this->redirect('addleader');
    }
}