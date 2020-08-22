<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/22/2:54 PM
 */

namespace App\Services;


use App\Models\Navigation;

class NavigationService
{


    /**
     * 获取导航信息
     * @param $where
     * @return array
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/22/4:22 PM
     */
    public function getNavigation($where)
    {

        return Navigation::query()->where($where)
            ->get(['id', 'name', 'url', 'parent_id', 'path', 'addtime', 'update_time', 'status', 'is_delete'])
            ->toArray();

    }


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

        return Navigation::query()->create($param);
    }


    /**
     * 获取导航信息列表
     * @param $where
     * @param array $columns
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/22/4:24 PM
     */
    public function getNavigationList($where, $columns = ['*'], $page, $pageSize)
    {

        $result['total'] = Navigation::query(function ($query) use ($where) {
            if (isset($where['keyWords'])) {
                $query->where('name', 'like', '%' . $where['keyWords'] . '%');
            }
        })->where()->count();

        $offset = ($page - 1) * $pageSize;

        $result['list'] = Navigation::query()->where(function ($query) use ($where) {
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
     * 导航删除操作
     * @param $where
     * @return int
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/22/4:59 PM
     */
    public function delNavigation($where)
    {

        return Navigation::query()->where($where)->update(['status' => 2]);

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

        return Navigation::query()->where($where)->update($param);
    }
}