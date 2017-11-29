<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年11月29日
* 最新修改时间：2017年11月29日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####关于我们控制器#####
* @author 代码狮
*
*/
namespace Admin\Controller;
use Think\Controller;
class AboutController extends Controller{
    
    //构造函数
    public function _initialize(){
        
    }
    //主
    public function index(){
        
    }
    //空操作
    public function _empty(){
        
    }
    
    public function edit(){
        
        
        
        if(IS_POST){
            
            //=========保存数据=========
            $model=M('about');
            //=========条件区
            $where=[];
            $where['about_id']=1;
            //=========保存数据区
            $save=[];
            $save['content']=I('post.content');
            // $save['edit_time']=time();
            //=========sql区
            $result=$model->where($where)->save($save);
            //=========保存数据end=========
            
            //=========判断=========
            if($result!==false){
                $res['res']=1;
                $res['msg']=$result;
            }else{
                $res['res']=-1;
                $res['msg']=$result;
            }
            //=========判断end=========
            
            //=========输出json=========
            echo json_encode($res);
            //=========输出json=========
            
            
        }else{
            
            
            $model=M('about');
            $where=[];
            $where['about_id']=1;
            $result=$model->where($where)->find();
            
            $this->assign('about',$result);
            $this->display();
            
            
        }
        
        
        
    }
    
    
    
    
}