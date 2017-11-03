<?php

namespace Admin\Controller;
use Think\Controller;

/**
 * +----------------------------------------------------------------------
 * 创建日期：2017年10月28日
 * +----------------------------------------------------------------------
 * https：//github.com/ALNY-AC
 * +----------------------------------------------------------------------
 * weixin：AJS0314
 * +----------------------------------------------------------------------
 * 通用控制器
 * @author 代马狮
 *
 */
class CurrencyController extends CommonController {

    /**
     * 更新数据
     * */
    public function u() {
        //      $fromName, $data
        $fromName = I('post.fromName');
        $data = I('post.data');
        $model = M($fromName);

        foreach ($data as $value) {

            $where = $value['id'];
            $save = $value['data'];
            $model -> where($where) -> save($save);

        }

    }

    public function uAll() {
        $where = I('post.where');
        $field = I('post.field');
        $fromName = I('post.fromName');
        $save[$field] = I('post.fieldValue');

        $model = M($fromName);
        $result = $model -> where($where) -> save($save);

        if ($result !== false) {

            $result_info['result'] = 'success';
            $result_info['message'] = "$result";

        } else {

            $result_info['result'] = 'error';
            $result_info['message'] = "error";

        }
        echo json_encode($result_info);
    }

}
