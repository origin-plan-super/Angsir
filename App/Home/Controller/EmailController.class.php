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
* #####邮件发送接口#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class EmailController extends Controller {
    
    
    /**
    * 发送验证码
    */
    public function sendCode(){
        /**
        *  1、get邮箱
        *  2、验证邮箱是否已经注册过了
        */
        $model=M('user');
        $user_id=I('get.user_id');
        $where['user_id']= $id;
        $result=$model->where($where)->find();
        session('code',null);
        if($result===null){
            //邮箱未注册
            $code=rand(1000,9999);
            session('code',$code,360);
            $result = sendMail($user_id,'Angsir昂先生网验证码',"<h1>Angsir昂先生网</h1><p>您的验证码是：".$code."，有效期为6分钟</p>");
            if($result){
                $res['res']=0;
            }else{
                $res['res']=-1;
            }
        }else{
            //邮箱已经注册过了
            $res['res']=-2;
        }
        echo json_encode($res);
        
    }
    
}