<?php

function getContent($id){
    
    $model=M('about');
    $where=[];
    $where['about_id']=$id;
    $result=$model->where($where)->find();
    
    return   $result;
    
}
function saveContent($id,$content){
    
    //=========保存数据=========
    $model=M('about');
    //=========条件区
    $where=[];
    $where['about_id']=$id;
    //=========保存数据区
    $save=[];
    $save['content']=$content;
    // $save['edit_time']=time();
    //=========sql区
    $result=$model->where($where)->save($save);
    //=========保存数据end=========
    
    //=========判断=========
    if($result!==false){
        $res['res']=1;
        $res['msg']=$result;
    }else{
        $res['res']=-1;
        $res['msg']=$result;
    }
    $res['sql']=$model->_sql();
    
    //=========判断end=========
    
    //=========输出json=========
    return $res;
    //=========输出json=========
    
}