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
* #####搜索控制器#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class QueryController extends Controller {
    
    /**
    * 搜索
    */
    public function query(){
        
        // array(4) {
        //     ["queryKey"] => array(3) {
        //       [0] => string(14) "%培训讲师%"
        //       [1] => string(14) "%预结算员%"
        //       [2] => string(8) "%教师%"
        //     }
        //     ["city_text"] => array(3) {
        //       [0] => string(11) "%昌平区%"
        //       [1] => string(11) "%丰台区%"
        //       [2] => string(11) "%平谷区%"
        //     }
        //     ["duty_id"] => array(2) {
        //       [0] => string(7) "%23001%"
        //       [1] => string(7) "%23004%"
        //     }
        //     ["industry_id"] => array(1) {
        //       [0] => string(7) "%32027%"
        //     }
        //   }
        
        
        
        $duty_id=I('get.duty_id');
        $industry_id=I('get.duty_id');
        $city_text=I('get.city_text');
        $queryKey=I('get.queryKey');
        
        $model=M('live');
        
        //职位
        $where['duty_id'] = array(
        'like',
        $duty_id,
        'OR'
        );
        $where['_logic'] = 'OR';
        //行业
        $where['industry_id'] = array(
        'like',
        $industry_id,
        'OR'
        );
        //地址
        $where['location'] = array(
        'like',
        $city_text,
        'OR'
        );
        //关键字
        $where['title'] = array(
        'like',
        $queryKey,
        'OR'
        );
        
        $start=I('get.start');
        $num=I('get.num');
        
        
        $type=I('get.type').'_count';
        
        
        $result = $model -> where($where) ->order($type.' desc')-> limit("$start,$num")->select();
        // dump($model->_sql());
        // dump($result);
        
        
        
        
        if($result !==null && $result !==false){
            $res['res']=count($result);
            $res['msg']=$result;
            // $res['sql']=$model->_sql();
        }else{
            $res['res']=-1;
        }
        
        echo json_encode($res);
        
        
        
        
        
    }
    
    /**
    * 根据排名显示初始简历
    */
    public function getInit(){
        /**
        * 排序查询
        */
        //SELECT t2.name AS deptname, count(*) AS count FROM sp_user AS t1, sp_dept AS t2 WHERE t1.dept_id = t2.id GROUP BY deptname;
        // $comment_info = $model -> field('t1.*,t2.*,') -> table('an_comment AS t1,an_user AS t2') -> where('t1.user_id = t2.user_id AND live_id="' .I('get.live_id') . '"') -> select();
        
        if(!empty(I('get.type'))){
            $model=M('live');
            $type=I('get.type').'_count';
            $result=$model->order($type.' desc')->limit(3)->select();
            if($result!==false && $result!==false){
                $res['res']=count($result);
                $res['msg']=$result;
            }else{
                $res['res']=-2;
                $res['msg']='没有数据';
            }
            
            
        }else{
            $res['res']=-1;
            $res['msg']='接口请求参数出错！';
        }
        
        if(I('get.debug')==='true'){
            dump($res);
            echo json_encode($res);
        }else{
            echo json_encode($res);
        }
        
    }
    
    
}