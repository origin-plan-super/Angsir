<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年11月16日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####用户管理控制器#####
* @author 代码狮
*
*/
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
    
    /**
    * 显示
    */
    public function index(){
        $this->display();
    }
    
    /**
    * 获得用户列表
    */
    public function getList(){
        // page=1&limit=30
        
        $model=M('User');
        $page=I('get.page')-1;
        $limit=I('get.limit');
        
        
        if(!empty(I('get.key'))){
            
            $key=I('get.key');
            
            //职位
            $where['user_name|user_id|user_age|user_address|industry_text|duty_text'] = array(
            'like',
            "%".$key."%",
            'OR'
            );
            
            $result= $model->limit("$page,$limit")->order('add_time asc')->where($where)->select();
            $res['count']=$model->where($where)->count();
            
        }else{
            
            $count= $model->count();
            $res['count']=$count;
            $result= $model->limit("$page,$limit")->order('add_time asc')->select();
            
        }
        
        
        if($result){
            $res['code']=0;
            $res['msg']='更新了'.$res['count'].'条数据';
            $res['data']= $result;
        }else{
            $res['code']=-1;
            $res['msg']='没有数据！';
        }
        echo json_encode($res);
        
    }
    
    
    
    public function show(){
        $model=M('user');
        
        if(IS_POST){
            
        }else{
            
            $where['user_id']=I('get.user_id');
            $user_info=$model->where($where)->find();
            $this->assign('user_info',$user_info);
            $this->display();
            
        }
        
    }
    
    /**
    * 保存用户字段操作
    * 可上传任意字段保存，慎用，以后加字段验证
    */
    public function saveInfo(){
        if(IS_POST){
            
            $save=I('post.save');
            $model=M('User');
            $where['user_id']=I('post.user_id');
            $result=$model->where($where)->save($save);
            if($result !==false){
                //修改成功
                $res['res']=0;
                $res['msg']=$result;
                
            }else{
                //修改失败
                $res['res']=-1;
                $res['msg']=$result;
            }
            $res['sql']=$model->_sql();
            
        }else{
            $res['res']=-1;
            $res['msg']='no';
        }
        
        echo json_encode($res);
        
    }
    
    /**
    * 删除一个用户
    */
    public function del(){
        
        if(IS_POST){
            
            $model=M('User');
            $where['user_id']=I('post.user_id');
            $result=$model->where($where)->delete();
            if($result !==false){
                //删除成功
                $res['res']=0;
                $res['msg']=$result;
                
            }else{
                //删除失败
                $res['res']=-1;
                $res['msg']=$result;
            }
            $res['sql']=$model->_sql();
            
        }else{
            $res['res']=-1;
            $res['msg']='no';
        }
        echo json_encode($res);
        
        
    }
    
}