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
* #####发布经历控制器#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class FbController extends CommonController {
    public function fb() {
        if(IS_POST){
            
            // array(23) {
            //     ["industry"] => array(2) {
            //       ["text"] => string(55) "计算机软件,通信/电信/网络设备,网络游戏"
            //       ["id"] => string(17) "32001,32004,32007"
            //     }
            //     ["duty"] => array(2) {
            //       ["text"] => string(59) "高级软件工程师,仿真应用工程师,需求工程师"
            //       ["id"] => string(17) "23001,23004,23007"
            //     }
            //     ["is_certificate"] => string(3) "否"
            //     ["entry_time"] => string(7) "2018/13"
            //     ["in_job_time"] => string(6) "200年"
            //     ["salary"] => string(10) "9999999.99"
            //     ["year_3_5_salary"] => string(3) "233"
            //     ["salary_type_0"] => string(6) "税后"
            //     ["salary_type_1"] => string(15) "无灰色收入"
            //     ["location"] => string(6) "火星"
            //     ["is_overtime"] => string(3) "是"
            //     ["overtime_info"] => string(6) "啥？"
            //     ["work_environment"] => string(6) "很好"
            //     ["Interpersonal_atmosphere"] => string(6) "很棒"
            //     ["male_to_female_ratio"] => string(24) "全是雄性火星生物"
            //     ["Is_the_turnover_of_personnel_frequent"] => string(51) "很频繁，毕竟是星际空间站，人流量大"
            //     ["rising_space_and_development_prospect"] => string(69) "有望能前往冥王星空间站，听说哪里很神秘而且很好"
            //     ["who_do_you_need_to_contact"] => string(54) "地球人、月球人、火星人，还有海王星人"
            //     ["a_typical_day_work"] => string(18) "给星舰拧螺丝"
            //     ["when_is_the_maximum_pressure"] => string(57) "一天要给500000艘星舰拧螺丝的时候压力最大"
            //     ["what_do_you_want_to_say_to_later_people"] => string(36) "大学千万别选择拧螺丝专业"
            //     ["story"] => string(99) "少拧了一颗螺丝，然后整艘星舰就在飞出空间站的那一刻在我眼前爆炸了！"
            //   }
            
            
            
            /**
            * 1、先判断用户有没有登录
            * 2、如果登录执行添加操作
            * 3、如果没有登录则提示没有登录
            *
            */
            
            
            
            /**
            * 内容字段
            */
            //行业
            $add['industry_text']=I('post.industry_text');
            $add['industry_id']=I('post.industry_id');
            //职位
            $add['duty_text']=I('post.duty_text');
            $add['duty_id']=I('post.duty_id');
            //是否有证书
            $add['is_certificate']=I('post.is_certificate');
            //入职时间
            $add['entry_time']=I('post.entry_time');
            //在岗时间
            $add['in_job_time']=I('post.in_job_time');
            //入职薪资
            $add['salary']=I('post.salary');
            //3～5年后薪资
            $add['year_3_5_salary']=I('post.year_3_5_salary');
            //税前税后
            $add['salary_type_0']=I('post.salary_type_0');
            //灰色收入
            $add['salary_type_1']=I('post.salary_type_1');
            //地点（工作地点）
            $add['location']=I('post.location');
            //是否经常加班
            $add['is_overtime']=I('post.is_overtime');
            //加班信息
            $add['overtime_info']=I('post.overtime_info');
            //工作环境
            $add['work_environment']=I('post.work_environment');
            //人际氛围
            $add['interpersonal_atmosphere']=I('post.interpersonal_atmosphere');
            //工作中男女比例
            $add['male_to_female_ratio']=I('post.male_to_female_ratio');
            //人员流动是否频繁
            $add['is_the_turnover_of_personnel_frequent']=I('post.is_the_turnover_of_personnel_frequent');
            //上升空间及发展前景
            $add['rising_space_and_development_prospect']=I('post.rising_space_and_development_prospect');
            //需要接触哪些方面的人
            $add['who_do_you_need_to_contact']=I('post.who_do_you_need_to_contact');
            //典型的一天工作
            $add['a_typical_day_work']=I('post.a_typical_day_work');
            //什么时候压力最大
            $add['when_is_the_maximum_pressure']=I('post.when_is_the_maximum_pressure');
            //想对后来人说点什么
            $add['what_do_you_want_to_say_to_later_people']=I('post.what_do_you_want_to_say_to_later_people');
            //一则自己亲身经历的职场故事
            $add['story']=I('post.story');
            // title
            $add['title']=I('post.title');
            
            /**
            * 必须的基本字段
            */
            //用户id
            $add['user_id']=session('user_id');
            //添加时间
            $add['add_time']=time();
            //修改时间
            $add['edit_time']=$add['add_time'];
            //经验id
            $add['live_id']=md5($add['user_id']. $add['add_time'].__KEY__);
            
            
            $model=M('Live');
            $result=$model->add($add);
            if($result!==false){
                $url_id['live_id']= $add['live_id'];
                $url=U('Article/article',$url_id);
                echo "<script>top.location.href='$url'</script>";
            }
            
            
            
        }else{
            $this->display();
            
        }
        
        
        
    }
    
}