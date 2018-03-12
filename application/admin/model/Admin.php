<?php

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    //
    public function getLastTimeAttr($val){
        return date('y/m/d',$val);
    }
}
