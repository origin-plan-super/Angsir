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
            if(empty(I('post.user_id'))||empty(I('post.user_pwd'))){
                //账户密码啥的没有
                $res['res']=-1;
            }else{
                //该输入的都输入了
                
                $pwd=$post['user_pwd'];
                $pwd=md5($pwd.__KEY__);
                $where['user_id']=$post['user_id'];
                $model=M('user');
                //先取出用户资料
                $result= $model->where($where)->find();
                if($result['user_pwd']===$pwd){
                    //密码正确，可以登录
                    
                    session('user_id',$result['user_id']);
                    session('user_name',$result['user_name']);
                    session('user_img',$result['user_img']);
                    
                    // $this->success('登录成功！');
                    $url=U('Index/index');
                    $res['res']=0;
                    
                }else{
                    //密码不正确，不能登录
                    $res['res']=-2;
                }
            }
            
            
        }else{
            //不是post
            $res['res']=-3;
            
        }
        echo json_encode($res);
        
        
    }
    /**
    * 注册
    */
    public function reg(){
        /*
        0：注册成功
        -1：必填字段为空
        -2：密码不等
        -3：插入到数据库的时候失败
        -4：用户已经存在
        -5：验证码错误
        */
        
        if(IS_POST){
            $post=I('post.');
            
            if(empty(I('post.user_id'))||empty(I('post.user_pwd1'))||empty(I('post.user_pwd2'))){
                // 必填字段为空
                $res['res']=-1;
            }else{
                
                
                //验证码正确
                //有必填字段
                $pwd1=I('post.user_pwd1');
                $pwd2=I('post.user_pwd2');
                $id=I('post.user_id');
                
                $model=M('user');
                $where['user_id']= $id;
                $result=$model->where($where)->find();
                if($result===null){
                    
                    
                    if($pwd1 === $pwd2){
                        //密码相等
                        
                        $add['add_time']=time();
                        $add['edit_time']=$add['add_time'];
                        $add['user_pwd']=md5($pwd2.__KEY__);
                        $add['user_id']=$id;
                        $add['user_name']=$id;
                        $add['contact']=$id;
                        
                        if($model->add($add)!==false){
                            
                            /**
                            * 完成注册后跳转到个人信息页面，让用户完善个人信息，注册的地方就不进行过多的信息录入
                            */
                            session('user_id',$add['user_id']);
                            session('user_name',$add['user_name']);
                            // session('user_img',$add['user_img']);
                            $res['res']=0;
                        }else{
                            //注册失败
                            $res['res']=-3;
                        }
                        
                        
                    }else{
                        //密码不等
                        $res['res']=-2;
                    }
                }else{
                    //用户已经存在
                    $res['res']=-4;
                }
                
                
            }
            
        }else{
        }
        echo json_encode($res);
    }
    
    
    
    public function sinOut(){
        
        session(null);
        $url=U('Index/index');
        echo "<script>top.location.href='$url'</script>";
        
        
    }
    
    /**
    * 找回密码
    */
    public function findPassword(){
        if(IS_POST){
            $post=I('post.');
            
            if(empty(I('post.user_id'))||empty(I('post.user_pwd1'))||empty(I('post.user_pwd2'))||empty(I('post.user_code'))){
                // 必填字段为空
                $res['res']=-1;
            }else{
                
                $code = session('code');
                session('code',null);
                $user_code=I('post.user_code');
                
                if($user_code==$code){
                    //验证码正确
                    //有必填字段
                    $pwd1=I('post.user_pwd1');
                    $pwd2=I('post.user_pwd2');
                    $id=I('post.user_id');
                    
                    $model=M('user');
                    $where['user_id']= $id;
                    
                    if($pwd1 === $pwd2){
                        //密码相等
                        
                        //修改密码
                        $save['edit_time']=time();
                        $save['user_pwd']=md5($pwd2.__KEY__);
                        
                        if($model->where($where)->save($save)!==false){
                            $user=   $model->where($where)->find();
                            session('user_id',$user['user_id']);
                            session('user_name',$user['user_name']);
                            // session('user_img',$add['user_img']);
                            $res['res']=0;
                        }else{
                            //修改失败
                            $res['res']=-3;
                        }
                        
                    }else{
                        //密码不等
                        $res['res']=-2;
                    }
                    
                }else{
                    // 5：验证码错误
                    $res['res']=-5;
                }
                
            }
            echo json_encode($res);
            
        }else{
            $this->display();
        }
        
        
    }
    
}