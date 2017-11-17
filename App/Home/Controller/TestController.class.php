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
* #####测试控制器#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
    public function index() {
        // $url_id['live_id']=234;
        // echo U('Article/article',$url_id);
        $code = session('code');
        echo $code;
        
    }
}
// <html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta http-equiv="X-UA-Compatible" content="ie=edge"><title>Document</title></head><body><h1>Hello<h1/></body></html>