<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年11月15日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####我的经历里面的点赞、评论等功能的控制器#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    
    
    public function show(){
        
        
        //取出储存的用户id
        $where['user_id']=I('get.user_id');
        //创建用户模型
        $model=M('user');
        //取出用户数据
        $result= $model->where($where)->find();
        $this->assign('user_info',$result);
        
        $model=M('Live');
        $where['user_id']=I('get.user_id');
        $result=$model->where($where)->select();
        $this->assign('live_info',$result);
        
        $this->display();
        
    }
    
    
}