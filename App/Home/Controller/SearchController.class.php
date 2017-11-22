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
* #####搜索简历控制器#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class SearchController extends Controller {
    public function Search() {
        $model=M('User');
        $result=$model->where('is_up = 1')->select();
        $this->assign('up_user_info',$result);
        
        $model=M('Hot');
        $Hot=$model->select();
        $this->assign('Hot',$Hot);
        $this->display();
    }
    
}