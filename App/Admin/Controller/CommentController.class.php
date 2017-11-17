<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年11月17日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####评论管理控制器#####
* @author 代码狮
*
*/
namespace Admin\Controller;
use Think\Controller;
class CommentController extends CommonController {
    
    
    
    /**
    * 删除一条评论
    */
    public function del(){
        
        $model=M('Comment');
        $where['comment_id']=I('get.comment_id');
        $result=$model->where($where)->delete();
        echo "<script>self.location=document.referrer;</script>";
        
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
    
    
}