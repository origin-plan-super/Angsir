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
class ArticleToolController extends CommonController {
    
    /**
    * 点赞功能
    */
    public function good(){
        
        /**
        * 1、先根据经历id和当前用户搜索点赞表
        * 2、如果点赞表的数据不为null，就点赞成功
        * 3、否则就不能点赞
        */
        
        $model=M('LiveGood');
        $where['live_id']=I('get.live_id');
        $where['user_id']=session('user_id');
        $result= $model->where($where)->count();
        
        if($result<=0){
            //如果这个用户没有点赞
            $add['user_id']=session('user_id');
            $add['live_id']=I('get.live_id');
            $result=$model->add($add);
            if($result!==false){
                //点赞成功
                
                $result_info['res']=1;
                $result_info['msg']='good true';
                
            }else{
                //点赞失败
                $result_info['res']=0;
                $result_info['msg']='good false';
            }
            
        }else{
            //已经点过赞了
            $result_info['res']=-1;
            $result_info['msg']='good not null';
        }
        echo json_encode($result_info);
        
    }
    
    
}