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
namespace Admin\Controller;
use Think\Controller;
class TestController extends Controller {
    public function index() {
        // dump(session());
        die;
        for ($i=0; $i < 100; $i++) {
            $rand=rand(1000000000,9999999999);
            $model=M('User');
            
            $add['user_id']=$rand.'@qq.com';
            $add['user_pwd']=md5('123'.__KEY__);
            $add['user_name']=  $add['user_id'];
            $add['add_time']=time();
            $add['edit_time']= $add['add_time'];
            $result=  $model->add($add);
            dump($add);
            if($result){
                dump('添加成功，result：'.$result);
                dump('数据：');
                dump($add);
            }else{
                dump('数据添加失败，result：'.$result);
                dump('数据：');
                dump($add);
            }
        }
        
        
        
        
        
        
        
        
        
    }
}
// <html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta http-equiv="X-UA-Compatible" content="ie=edge"><title>Document</title></head><body><h1>Hello<h1/></body></html>