<?php

namespace App\Model;

use DemeterChain\C;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public $primaryKey = 'cate_id';

    public $fillable = ['cate_name', 'cate_title', 'cate_keywords', 'cate_describe', 'cate_view', 'cate_order', 'cate_pid'];

    /**
    * 文章分类树
    * @param $data
    * @param string $fieldId
    * @param string $fieldPid
    * @param int $pidValue
    * @param string $fileName
    * @return array
    */
    public static function getCategoryTrees($data, $fieldId = 'id', $fieldPid = 'pid', $pidValue = 0, $fileName = "cate_name")
    {
        $result = [];
        foreach ($data as $k => &$v) {
            if ($v->$fieldPid == $pidValue) {
                $result[] = $data[$k];
                foreach ($data as $m => &$n) {
                    if ($n->$fieldPid == $v->$fieldId) {
                        $n->$fileName = '┋﹋﹋﹋﹋﹋'.$n->$fileName;
                        $result[] = $data[$m];
                    }
                }
            }
        }
        return $result;
    }

    public function getRouteKeyName()
    {
        return 'cate_id';
    }


    public function articles()
    {
        return $this->hasMany('App\Model\Articles', 'art_cate_id', 'cate_id');
    }
}
