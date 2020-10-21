<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/22/2:55 PM
 */

namespace App\Services;


use App\Models\SlideShow;

class SlideShowService
{

    /**
     * 导航信息添加
     * @param $param
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/22/4:23 PM
     */
    public function store($param)
    {
        return SlideShow::query()->create($param);
    }


    /**
     * 获取轮播图
     * @param $where
     * @param array $columns
     * @return array
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/22/5:27 PM
     */
    public function getSlideShow($where, $columns = ['*'])
    {

        return SlideShow::query()->where($where)
            ->get($columns)
            ->toArray();

    }


    /**
     * 轮播图列表
     * @param $where
     * @param array $columns
     * @param $page
     * @param $pageSize
     * @return mixed
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/22/5:28 PM
     */
    public function getSlideList($where, $columns = ['*'], $page, $pageSize)
    {

        $result['total'] = SlideShow::query(function ($query) use ($where) {
            if (isset($where['keyWords'])) {
                $query->where('name', 'like', '%' . $where['keyWords'] . '%');
            }
        })->where()->count();

        $offset = ($page - 1) * $pageSize;

        $result['list'] = SlideShow::query()->where(function ($query) use ($where) {
            if (isset($param['keyWords'])) {
                $query->where('name', 'like', '%' . $where['keyWords'] . '%');
            }
        })
            ->offset($offset)
            ->limit($pageSize)
            ->get($columns);

        return $result;

    }


    /**
     * 删除操作
     * @param $where
     * @return int
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/22/4:59 PM
     */
    public function delSlide($where)
    {

        return SlideShow::query()->where($where)->update(['status' => 2]);

    }


    /**
     * 更新操作
     * @param $where
     * @param $param
     * @return int
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/22/5:04 PM
     */
    public function update($where, $param)
    {

        return SlideShow::query()->where($where)->update($param);
    }

}