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
* #####我的经历控制器#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class ArticleController extends Controller {
    
    /**
    * 显示功能
    */
    public function article() {
        /**
        * 必须传live_id进来，要不然就返回上一页
        *
        */
        if(empty(I('get.live_id'))){
            //没有传id
            
            if(!empty(session('user_id'))){
                $url=U('Center/my');
                echo "<script>top.location.href='$url'</script>";
            }else{
                $title='未登录';
                $info='请登录后再操作';
                $pageTitle='我的经历';
                $this->assign('title',$title);
                $this->assign('info',$info);
                $this->assign('pageTitle',$pageTitle);
                $this->display('jump/jump');
            }
            
            
        }else{
            //传了id
            $live_model=M('Live');
            $where['live_id']=I('get.live_id');;
            $live_info= $live_model->where($where)->find();
            
            
            
            
            if($live_info !== null && $live_info !== false){
                /**
                *======================
                * 1、先处理阅读量
                * 2、如果是未登录的用户就不用处理
                *======================
                *
                */
                
                $model=M('liveRead');
                $where=[];
                $where['live_id']=I('get.live_id');
                
                if(!empty(session('user_id'))){
                    //如果是登录的用户
                    $where['user_id']=session('user_id');
                    $liveRead= $model->where($where)->count();
                    if($liveRead<=0){
                        //如果阅读统计中没有这个用户的数据，就添加
                        $add['user_id']=session('user_id');
                        $add['live_id']=I('get.live_id');
                        $model->add($add);
                    }
                }
                
                $where=[];
                $where['live_id']=I('get.live_id');;
                //获得计数
                $readCount= $model->where($where)->count();
                //修改经历表中的阅读量
                $save['read_count']=$readCount;
                $live_model->where($where)->save($save);
                /**
                *======================
                * 阅读量end
                *======================
                */
                
                $model=M('user');
                $where=[];
                $where['user_id']=$live_info['user_id'];
                $user_info= $model->where($where)->find();
                
                
                /**
                *======================
                * 点赞操作
                *======================
                */
                
                $model=M('LiveGood');
                $where=[];
                $where['live_id']=I('get.live_id');;
                $liveGoodCount= $model->where($where)->count();
                //修改经历表中的点赞量
                $save['good_count']=$liveGoodCount;
                $live_model->where($where)->save($save);
                
                /**
                *======================
                * 点赞操作end
                *======================
                */
                
                /**
                *======================
                * 评论，联表
                *======================
                */
                //SELECT t2.name AS deptname, count(*) AS count FROM sp_user AS t1, sp_dept AS t2 WHERE t1.dept_id = t2.id GROUP BY deptname;
                
                
                
                
                $model=M('');
                $comment_info = $model -> field('t1.*,t2.*,t1.add_time as live_add_time')->order('t1.add_time desc') -> table('an_comment AS t1,an_user AS t2') -> where('t1.user_id = t2.user_id AND live_id="' .I('get.live_id') . '"') -> select();
                
                // dump($comment_info);
                // die;
                
                
                /**
                *======================
                * 评论end
                *======================
                */
                
                $this->assign('readCount',$readCount);
                $this->assign('liveGoodCount',$liveGoodCount);
                $this->assign('comment_info',$comment_info);
                $this->assign('live_info',$live_info);
                $this->assign('user_info',$user_info);
                
                
                /**
                *======================
                * 管理功能
                *======================
                */
                
                /**
                *======================
                * 管理功能end
                *======================
                */
                
                
                if(!empty(session('admin_id'))){
                    $this->assign('is_admin',true);
                }
                
                $this->display();
            }else{
                $this->error('没有相关经历！');
            }
            
            
        }
        
        
    }
    
    
    
}