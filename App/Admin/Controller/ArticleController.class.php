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
* #####经历管理控制器#####
* @author 代码狮
*
*/
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends CommonController {
    
    /**
    * 显示
    */
    public function index(){
        $this->display();
    }
    
    /**
    * 获得经历列表
    */
    public function getList(){
        
        $model=M('live');
        $page=I('get.page')-1;
        $limit=I('get.limit');
        
        if(!empty(I('get.key'))){
            
            $key=I('get.key');
            
            //职位
            $where['live_id|user_id|industry_text|duty_text'] = array(
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
    /**
    * 删除一个用户
    */
    public function del(){
        
        if(IS_POST){
            
            $model=M('Live');
            $where['live_id']=I('post.live_id');
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