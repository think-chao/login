<?php

namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Admin;
use think\Request;

class Adminlist extends Base{
    public function index(){
        //读取管理员信息
        $admin=Admin::get(['username'=>'admin']);
        //当前信息赋值给模板
        $this->view->assign('admin',$admin);
        return $this->fetch("list");
    }
    public function role(){
        return $this->fetch("roleplay");
    }
    public function edit(Request $request){
        $admin=Admin::get($request->param('id'));
        //当前信息赋值给模板
        $this->view->assign('admin',$admin);
        return $this->fetch("admin_edit");
    }

    public function update(Request $request){

        if( $request->isAjax(true)){
            //param 方法获取所有数据
            $data=array_filter($request->param());
            $map=['is_update'=>$data['is_update']];
            $res=Admin::update($data,$map);
            $status=1;
            $message="更新成功";
            if (is_null($res)){
                $status=0;
                $message="更新失败";
            }
            return ['status'=>$status,'message'=>$message];
        }

    }

}