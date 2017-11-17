<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年11月14日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####个人中心控制器#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class CenterController extends CommonController {
    public function Center() {
        
        if(IS_POST){
            
            /**
            *
            * 保存用户设置
            *
            */
            $save=I('post.');
            $save['edit']=time();
            
            $where['user_id']=session('user_id');
            $model=M('user');
            $result=$model->where($where)->save($save);
            if($result!==false){
                $res['res']=0;
            }else{
                $res['res']=-1;
            }
            echo json_encode($res);
            
        }else{
            
            //取出储存的用户id
            $where['user_id']=session('user_id');
            //创建用户模型
            $model=M('user');
            //取出用户数据
            $result= $model->where($where)->find();
            $this->assign('user_info',$result);
            $this->display();
        }
        
        
    }
    /**
    * 我的经历
    */
    public function my(){
        
        $model=M('Live');
        $where['user_id']=session('user_id');
        $result=$model->where($where)->select();
        $this->assign('live_info',$result);
        $this->display();
        
    }
    public function am(){
        $this->display();
        
    }
    
}