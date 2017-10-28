<?php
namespace UserV0_1\Model;
use Think\Model;

/**
 * +----------------------------------------------------------------------
 * 创建日期：2017年10月28日
 * +----------------------------------------------------------------------
 * https：//github.com/ALNY-AC
 * +----------------------------------------------------------------------
 * weixin：AJS0314
 * +----------------------------------------------------------------------
 * 用户反馈模型
 * @author 代马狮
 *
 */

class OpinionModel extends Model {

    public function addOpinion($user_id, $type, $content) {
        //opinion_id
        //info

        $date['add_time'] = time();
        $date['state'] = 1;

        $date['user_id'] = $user_id;
        $date['type'] = $type;
        $date['content'] = $content;

        $date['opinion_id'] = md5($date['user_id'] . $date['type'] . $date['add_time'] . rand());

        $result = $this -> add($date);
        if ($result) {
            //添加了
            $result_info['result'] = 'success';
            $result_info['message'] = 'add Opinion true';
        } else {
            //失败了
            $result_info['result'] = 'error';
            $result_info['message'] = "no add Opinion";
        }

        return $result_info;
    }

}
