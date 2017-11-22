<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年11月23日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####热搜控制器#####
* @author 代码狮
*
*/
namespace Admin\Controller;
use Think\Controller;
class HotController extends Controller {
    
    /**
    * 显示热搜列表
    */
    public function showList() {
        
        $this->display();
        
    }
    
    /**
    * 获得列表
    */
    public function getList(){
        // page=1&limit=30
        
        $model=M('Hot');
        $page=I('get.page');
        $limit=I('get.limit');
        $page=($page-1)* $limit;
        
        if(!empty(I('get.key'))){
            
            $key=I('get.key');
            
            //职位
            $where['hot_id|value'] = array(
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
    * 添加热搜
    */
    public function add(){
        
        if(IS_POST){
            
            $add['value']=I('post.value');
            $add['add_time']=time();;
            $add['edit_time']=$add['add_time'];
            $add['hot_id']=md5($add['value'].$add['time'].rand().__KEY__);
            $model=M('Hot');
            $r= $model->add($add);
            if($r!==false){
                $res['res']=0;
                $res['msg']='add true';
                
            }else{
                $res['res']=-1;
                $res['msg']='add false';
            }
            
        }else{
            $res['res']=-998;
            $res['msg']='no post';
        }
        echo json_encode($res);
        
    }
    
    /**
    * 保存字段操作
    * 可上传任意字段保存，慎用，以后加字段验证
    */
    public function saveInfo(){
        if(IS_POST){
            
            $save=I('post.save');
            $model=M('hot');
            $where['hot_id']=I('post.hot_id');
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
    * 删除一个
    */
    public function del(){
        
        if(IS_POST){
            
            $model=M('hot');
            $where['hot_id']=I('post.hot_id');
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
    /**
    *
    * 批量删除
    *
    */
    public function removes() {
        
        if (!empty(I('post.hot_id'))) {
            
            $hot_id = I('post.hot_id');
            $where = "hot_id in($hot_id)";
            $model = M('hot');
            $result = $model -> where($where) -> delete();
            
            if($resut!==false){
                $res['res'] = $result;
                $res['msg'] ='成功' ;
            }else{
                $res['res'] = -1;
                $res['msg'] =$result ;
            }
            
        }
        
        echo json_encode($res);
    }
    
}