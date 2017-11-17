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
* #####上传文件控制器#####
* @author 代码狮
*rw
*/
namespace Home\Controller;
use Think\Controller;
class FileController extends CommonController {
    
    /**
    * 单个文件上传
    */
    public function upFile() {
        $file = $_FILES['file'];
        if (!$file['error']) {
            //定义配置
            $cfg = array(
            //配置上传路径
            'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH_USER);
            //实例化上传类
            $upload = new \Think\Upload($cfg);
            //开始上传
            $info = $upload -> uploadOne($file);
            //判断是否上传成功
            if ($info) {
                
                //图片地址
                $img_url = UPLOAD_ROOT_PATH_USER . $info['savepath'] . $info['savename'];
                $result['code'] = 0;
                $result['msg'] = '成功';
                $result['data'] =[];
                $result['data']['src'] = $img_url;
                
            }else{
                $result['code'] = 0;
                $result['msg'] = '上传失败';
            }
        }else{
            $result['code'] = 0;
            $result['msg'] = '文件错误';
        }
        echo json_encode($result);
        
    }
}