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
* #####评论控制器#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class CommentController extends CommonController {
    
    /**
    *
    * 通过live获得回复列表
    *
    */
    public function getList(){
        
        
        
    }
    
    /**
    *
    * 添加一个回复
    */
    public function add(){
        
        
        $add['content']=I('post.content');
        $add['live_id']=I('post.live_id');
        $add['user_id']=session('user_id');
        $add['add_time']=time();
        $add['edit_time']=$add['add_time'];
        $add['comment_id']=md5($add['live_id'].$add['user_id'].$add['add_time'].__KEY__.rand());
        $model=M('Comment');
        $result=$model->add($add);
        
        if($result!==false){
            
            $url_id['live_id']= $add['live_id'];
            $url=U('Article/article',$url_id);
            echo "<script>top.location.href='$url'</script>";
        }
        
        
    }
    
    /**
    * 回复一个评论
    */
    public function reply(){
        
        $post=I('post.');
        
        $model=M('Comment');
        $add['live_id']=I('post.live_id');
        $add['content']=I('post.content');
        $add['super_id']=I('post.super_id');
        $add['user_id']=session('user_id');
        $add['add_time']=time();
        $add['edit_time']=$add['add_time'];
        $add['comment_id']=md5($add['super_id'].$add['user_id'].$add['add_time'].__KEY__.rand());
        
        $result=$model->add($add);
        
        $msg['user_name']= session('user_name');
        $msg['add_time']= date('Y-m-d H:i:s');
        $msg['url']= U('User/show','user_id='.$add['user_id']);
        
        
        if($result!==false){
            $res['res']=0;
            $res['msg']=$msg;
        }else{
            $res['res']=-1;
            $res['msg']=$model->_sql();
        }
        echo json_encode($res);
    }
    
    
}