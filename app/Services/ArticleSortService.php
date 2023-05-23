<?php


namespace App\Services;

use App\Enum\ArticleSortEnum;
use App\Models\ArticleSort;
use App\Services\Common\CommonService;

class ArticleSortService
{
    /**
     * 获取单条信息
     * @param $where
     * @param array $columns
     * @return array
     *
     */
    public function getArticleSort($where, $columns = ['*'])
    {

        return ArticleSort::query()->where($where)
            ->get($columns)
            ->toArray();

    }


    /**
     * 列表
     * @param $where
     * @param array $columns
     * @param $page
     * @param $pageSize
     * @return mixed
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/22/5:28 PM
     */
    public function getSortList($where, $columns = ['*'], $page, $pageSize)
    {

        $result['total'] = ArticleSort::query()
            ->where(function ($query) use ($where) {
                if (isset($where['keyword'])) {
                    $query->where('sort_name', 'like', '%' . $where['keyword'] . '%');
                }
            })->count();

        $offset = ($page - 1) * $pageSize;

        $result['list'] = ArticleSort::query()
            ->where(function ($query) use ($where) {
                if (isset($param['keyword'])) {
                    $query->where('sort_name', 'like', '%' . $where['keyword'] . '%');
                }
            })
            ->offset($offset)
            ->limit($pageSize)
            ->get($columns)
            ->toArray();

        $sort = array_column($this->getSort(), 'label', 'id');

        foreach ($result['list'] as &$val) {

            $val['parent_name'] = $sort[$val['parent_id']] ?? '顶级分类';

        }

        return $result;

    }


    /**
     * 添加
     * @param $param
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     *
     */
    public function store($param)
    {
        return ArticleSort::query()->create($param);
    }

    /**
     * 删除操作
     * @param $where
     * @return int
     *
     */
    public function del($where)
    {

        return ArticleSort::query()->where($where)->update(['is_delete' => 1]);

    }


    /**
     * 更新操作
     * @param $where
     * @param $param
     * @return int
     *
     */
    public function update($where, $param)
    {

        return ArticleSort::query()->where($where)->update($param);
    }


    public function getSort()
    {
        $result = ArticleSort::query()->where(['status' => 1])
            ->orderBy('id', 'asc')
            ->get(['id', 'sort_name as label', 'parent_id'])
            ->toArray();

        return $result;
    }

    public function getSortTree()
    {
        $result = ArticleSort::query()->where(['status' => 1])
            ->orderBy('id', 'asc')
            ->get(['id', 'sort_name as label', 'parent_id'])
            ->toArray();
        $result = CommonService::getTree($result, 0);
        $queue = array('id' => 0, 'label' => '顶级分类', 'parent_id' => 0);
        array_unshift($result, $queue);
        return array_merge($result);
    }

}
