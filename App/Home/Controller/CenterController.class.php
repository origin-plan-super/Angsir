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
* #####个人中心控制器#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class CenterController extends Controller {
    public function Center() {
        
        
        if(IS_POST){
            // array(7) {
            //     ["portrait"] => string(35) "images/myresume/default_headpic.png"
            //     ["headPic"] => string(0) ""
            //     ["user_name"] => string(12) "这是昵称"
            //     ["user_age"] => string(12) "这是年龄"
            //     ["industry"] => array(2) {
            //       ["text"] => string(55) "计算机软件,通信/电信/网络设备,网络游戏"
            //       ["id"] => string(17) "32001,32004,32007"
            //     }
            //     ["duty"] => array(2) {
            //       ["text"] => string(44) "高级硬件工程师,硬件工程师,其他"
            //       ["id"] => string(17) "23015,23016,23017"
            //     }
            //     ["user_address"] => string(12) "这是地址"
            //   }
            
            $post=I('post.');
            dump($post);
            
        }else{
            $this->display();
        }
        
        
    }
    public function my(){
        
        $this->display();
        
    }
    public function am(){
        $this->display();
        
    }
    
}