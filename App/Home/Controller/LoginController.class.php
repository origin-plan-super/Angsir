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
* #####登录控制器#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    
    /**
    * 登录
    */
    public function login(){
        
        // array(4) {
        //     ["callback"] => string(22) "/zhiwei/view/29546736/"
        //     ["username"] => string(5) "admin"
        //     ["password"] => string(8) "admin123"
        //     ["remember"] => string(2) "on"
        //   }
        
        if(IS_POST){
            
            $post= I('post.');
            dump($post);
            if(empty(I('post.user_id'))||empty(I('post.user_pwd'))){
                //账户密码啥的没有
                $this->error('账户或密码不能为空！请重新登录。',U('Index/index'));
                
            }else{
                //该输入的都输入了
                
                $pwd=$post['pwd'];
                $pwd=md5($pwd.__KEY__);
                
                $where['user_pwd']=$pwd;
                
                $model=M('user');
                //先取出用户资料
                $result= $model->where($where)->find();
                if($result['user_pwd']===$pwd){
                    //密码正确，可以登录
                    $this->success('登录成功！');
                    
                }else{
                    //密码不正确，不能登录
                    $this->success('登录失败，密码或账户错误！');
                    
                }
            }
            
            
        }else{
            echo '登录接口';
        }
        
        
    }
    /**
    * 注册
    */
    public function reg(){
        
        
        if(IS_POST){
            $post=I('post.');
            
            if(empty(I('post.user_id'))||empty(I('post.user_pwd1'))||empty(I('post.user_pwd2'))){
                // 必填字段为空
                $this->error('必填字段不能为空！请重新注册！',U('Index/index'));
                
            }else{
                //有必填字段
                $pwd1=I('post.user_pwd1');
                $pwd2=I('post.user_pwd2');
                $id=I('post.user_id');
                
                
                if($pwd1 === $pwd2){
                    //密码相等
                    
                    
                    
                    $add['add_time']=time();
                    $add['edit_time']=$add['add_time'];
                    $add['user_pwd']=md5($pwd2.__KEY__);
                    $add['user_id']=$id;
                    $add['user_name']=$id;
                    
                    $model=M('user');
                    
                    
                    
                    if($model->add($add)!==false){
                        /**
                        * 完成注册后跳转到个人信息页面，让用户完善个人信息，注册的地方就不进行过多的信息录入
                        */
                        $this->success('注册成功！',U('Center/Center'));
                    }
                    
                    
                }else{
                    //密码不等
                    $this->error('两次输入的密码不一样',U('Index/index'));
                    
                }
                
            }
            
        }else{
            echo '登录接口';
        }
        
        
        
        
    }
    
}