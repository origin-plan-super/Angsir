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
* #####需要登录权限的继承本控制器#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    
    //ThinkPHP提供的构造方法
    public function _initialize() {
        $id = session('user_id');
        
        if (empty($id)) {
            // $url = U('Index/index');
            
            
            if(IS_AJAX){
                $echo['res']=-999;
                $echo['msg']='未登录！';
                echo json_encode($echo);
            }else{
                // $this->error('请先登录！');
                // $url=U('Index/index');
                // echo "<script>top.location.href='$url'</script>";
                $title='未登录';
                $info='请登录后再操作';
                $pageTitle='请登录';
                $this->assign('title',$title);
                $this->assign('info',$info);
                $this->assign('pageTitle',$pageTitle);
                $this->display('jump/jump');
            }
            
            // echo "<script>top.location.href='$url'</script>";
            exit ;
            
        }
        
    }
    
}