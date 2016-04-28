<?php
/**
 * Created by PhpStorm.
 * User: kphcdr
 * Date: 16/3/8
 * Time: 下午7:01
 */

namespace app\model;

use ppphp\cache;

class articleModel extends \ppphp\model
{
    public $table = 'article';
    public function doc()
    {
        $cache = new cache();
        $data = $cache->get('docList');
        if(!$data) {
            $data = $this->select($this->table, ['id', 'name'], [
                'AND'=>['is_use' => 0,'category'=>1]
            ]);
            $cache->set('docList',$data);
        }
        return $data;
    }

    public function blog()
    {
        $cache = new cache();
        $data = $cache->get('blogList');
        if(!$data) {
            $data = $this->select($this->table, ['id', 'name'], [
                'AND'=>['is_use' => 0,'category'=>2]
            ]);
            $cache->set('blogList',$data);
        }
        return $data;
    }

    public function getLastArticleId()
    {
        $data = $this->get($this->table,['id'],[
            'AND'=>['is_use' => 0,'category'=>2],
            'ORDER'=>['id','desc']
        ]);
        return $data['id'];
    }
}