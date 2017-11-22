<?php
namespace UserV0_1\Controller;
use Think\Controller;
class IndexNavController extends Controller {
    
    public function getList(){
        
        /**
        *
        *
        * 先获得分类
        */
        
        
        $model=M();
        
        // SELECT t1.*,t2.*,t3.* from mia_goods as t1,mia_class as t2, mia_class as t3 where(t1.class_id = t2.class_id and t2.super_id = t3.class_id);
        // SELECT t1.*,t2.*,t3.* FROM mia_goods AS t1,mia_class AS t2,mia_class as t3 WHERE ( t1.class_id = t2.class_id AND t2.super_id = t3.class_id )
        
        // $result = $model -> field('t1.*,t2.*,t3.*,t2.title as t2_title,t3.title as t3_title') -> table('mia_goods AS t1,mia_class AS t2,mia_class as t3') -> where('t1.class_id = t2.class_id AND t2.super_id = t3.class_id') -> select();
        
        
        $arr = array(
        't1.*',
        't2.*',
        't3.*',
        't1.title' => 't1_title',
        't2.title' => 't2_title',
        't3.title' => 't3_title',
        't2.class_id' => 't2_id',
        't3.class_id' => 't3_id',
        't1.head_img' => 't1_head_img'
        );
        
        
        
        
        $model=M();
        $result = $model -> field( $arr) -> table('mia_goods AS t1,mia_class AS t2,mia_class as t3') -> where('t1.class_id = t2.class_id AND t2.super_id = t3.class_id') -> select();
        $list=[];
        
        
        // for ($i=0; $i < count( $result); $i++) {
        
        
        //     $list[$i]['nav_info']['title']=$value['t3_title'];
        //     $list[$i]['nav_info']['id']=$value['t3_id'];
        //     $list[$i]['goods_info'][]=$value;
        
        // }
        
        
        
        
        foreach ($result as $value) {
            
            $list[$value['t3_id']]['nav_info']['title']=$value['t3_title'];
            $list[$value['t3_id']]['nav_info']['id']=$value['t3_id'];
            $list[$value['t3_id']]['goods_info'][]=$value;
            
        }
        // dump($list);
        
        
        $model = M();
        $goodsItems = $model -> field('t1.*,t2.goods_id,t2.title,t2.price,t2.str_price,t2.head_img') -> table('mia_recommend as t1,mia_goods as t2') -> where('t1.goods_id = t2.goods_id') -> order('t1.sort asc') -> select();
        
        $result_info['result'] = 'success';
        $result_info['message'] = $list;
        $result_info['goodsItems'] = $goodsItems;
        
        echo json_encode($result_info);
        
        
    }
    
    
    
}