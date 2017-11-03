<?php
namespace Admin\Model;
use Think\Model;

/**
 * +----------------------------------------------------------------------
 * 创建日期：2017年11月2日
 * +----------------------------------------------------------------------
 * https：//github.com/ALNY-AC
 * +----------------------------------------------------------------------
 * weixin：AJS0314
 * +----------------------------------------------------------------------
 * 通用模型
 * @author 代马狮
 *
 */

class CurrencyModel extends Model {

    /**
     * 更新数据
     * */
    public function u($fromName, $data) {
        $model = M($fromName);

        foreach ($data as $value) {

            $where = $value['id'];
            $save = $value['data'];
            $model -> where($where) -> save($save);

        }

    }

    /**
     * 新增数据
     * */
    public function a() {

    }

    /**
     * 删除数据
     * */
    public function d() {

    }

    /**
     * 查询多个
     * */
    public function s() {

    }

    /**
     * 查询一个
     * */
    public function f() {

    }

}
?>