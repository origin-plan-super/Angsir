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
                //组装回复列表
                
                //新数组
                
                foreach ($comment_info as $key => $value1) {
                    
                    if($value1['super_id']){
                        //如果有父级ID
                        
                        foreach ($comment_info as $key2 => $value2) {
                            if($value2['comment_id']==$value1['super_id']){
                                //找到了父级
                                $comment_info[$key2]['list'][]=$value1;
                                unset($comment_info[$key]);
                            }
                            
                        }
                        
                        
                    }
                    
                }
                
                
                //统计回复总数
                $model=M('Comment');
                $where=[];
                $where['live_id']=I('get.live_id');;
                $commentCount=$model->where($where)->count();
                
                // dump($comment_info);
                // die;
                
                
                /**
                *======================
                * 评论end
                *======================
                */
                
                $this->assign('readCount',$readCount);//阅读量
                $this->assign('liveGoodCount',$liveGoodCount);//点赞量
                $this->assign('comment_info',$comment_info);//回复的arr
                $this->assign('commentCount',$commentCount);//回复的数量
                $this->assign('live_info',$live_info);//简历信息
                $this->assign('user_info',$user_info);//用户信息
                
                
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
                
                // http://127.0.0.1:12138/Angsir/index.php/Home/Article/article/live_id/657ba3f7958816e330b6ffccc632698c
                
                
                
                // jump('找不到相关经历！','经历可能已经被删除！','查看经历');
                $title='找不到相关经历！';
                $info='经历可能已经被删除！';
                $pageTitle='查看经历';
                $this->assign('title',$title);
                $this->assign('info',$info);
                $this->assign('pageTitle',$pageTitle);
                $this->display('jump/jump');
                
            }
            
            
        }
        
        
    }
    
    /**
    * 删除经历
    */
    public function del(){
        
        if(IS_POST){
            //记录id
            $id=I('post.id');
            $model=M('live');
            $where['live_id']=$id;
            $where['user_id']=session('user_id');
            $result=$model->where($where)->delete();
            if($result){
                //删除经历的关联，
                //1、经历的评论
                $model=M('Comment');
                $model->where($where)->delete();
                
                $res['res']=1;
                $res['msg']=$result;
            }else{
                $res['res']=-1;
                $res['msg']=$result;
            }
            echo json_encode($res);
        }
    }
    
    
    
}