<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/17/5:12 PM
 */

namespace App\Services;


use App\Models\Menu;
use App\Services\Common\CodeService;

class MenuService
{

    /**
     * 添加菜单
     * @param $param
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|int
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/18/11:18 PM
     */
    public function store($param)
    {

        $result = Menu::query()->create($param);

        return $result;
    }


    /**
     * 获取菜单列表
     * @param $where
     * @param array $columns
     * @param $page
     * @param $pageSize
     * @return mixed
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/24/5:18 PM
     */
    public function getMenuList($where, $columns = ['*'],$page, $pageSize)
    {

        $result['total'] = Menu::query()
            ->where(function ($query) use ($where) {
                if (isset($param['keyWords'])) {
                    $query->where('name', 'like', '%' . $where['keyWords'] . '%');
                }
            })->count();

        $offset = ($page - 1) * $pageSize;

        $result['list'] = Menu::query()->where(function ($query) use ($where) {
            if (isset($param['keyWords'])) {
                $query->where('name', 'like', '%' . $where['keyWords'] . '%');
            }
            })
            ->offset($offset)
            ->limit($pageSize)
            ->get($columns)
            ->toArray();

        return $result;
    }


    /**
     * 删除菜单
     * @param $where
     * @return int
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/18/11:28 PM
     */
    public function delMenu($where)
    {

        return Menu::query()->where($where)->update(['is_delete' => 1]);
    }


    /**
     * 菜单信息更新
     * @param $where
     * @param $param
     * @return int
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/18/11:30 PM
     */
    public function updateMenu($where, $param)
    {

        return Menu::query()->where($where)->update($param);
    }


    /**
     * 获取左侧菜单
     * @return array
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/18/11:33 PM
     */
    public function getSideMenu()
    {
        $result = Menu::query()->where(['status', 1])
            ->orderBy('id', 'asc')
            ->get(['id', 'name as title', 'parent_id', 'url', 'icon'])
            ->toArray();

        return $result;
    }
}