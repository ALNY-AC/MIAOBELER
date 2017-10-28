<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {

    public function index() {
        if (IS_POST) {
            $url = I('post.url');
            session('admin_url', $url);
            echo U($url);
        } else {

            $admin_url = session('?admin_url');

            if ($admin_url) {

                $this -> assign('admin_url', U(session('admin_url')));
                $this -> display();
            } else {
                $this -> display();
            }

        }

    }

}
