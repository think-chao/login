<?php
namespace app\admin\controller;

use app\admin\common\Base;

class Quelist  extends Base{
    public function index(){
        return $this->fetch("qlist");
    }
    public function dellist(){
        return $this->fetch("dlist");
    }
}