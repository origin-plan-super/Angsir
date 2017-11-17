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
* #####主页控制器#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index() {
        
        
        $model=M('User');
        $result=$model->where('is_up = 1')->select();
        $this->assign('up_user_info',$result);
        
        $this->display();
    }
    public function about(){
        $this->display();
        
    }
    
}