<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/17/5:13 PM
 */

namespace App\Services;


use App\Models\System;
class SystemService
{

    /**
     * 获取系统参数
     * @param $where
     * @return array
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/18/11:37 PM
     */
    public function getSystem($where)
    {

        $result = System::query()
            ->where($where)
            ->get(['id', 'sys_name', 'sys_value', 'sys_explain', 'sys_type', 'create_time', 'update_time', 'status', 'is_delete'])
            ->toArray();

        return $result;


    }


    /**
     * 获取系统参数列表
     * @param $where
     * @param $page
     * @param $pageSize
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/18/11:38 PM
     */
    public function getSystemList($where, $page, $pageSize)
    {

        $result['total'] = System::query()->where(function ($query) use ($where) {
            if (isset($param['keyword'])) {
                $query->where('sys_name', 'like', '%' . $where['keyWords'] . '%');
            }
        })->count();

        $offset = ($page - 1) * $pageSize;

        $result['list'] = System::query()
            ->where(function ($query) use ($where) {
                if (isset($where['keyword'])) {
                    $query->where('sys_name', 'like', '%' . $where['keyWords'] . '%');
                }
            })
            ->offset($offset)
            ->limit($pageSize)
            ->get(['id', 'sys_name', 'sys_value', 'sys_explain', 'sys_type', 'create_time', 'update_time', 'status', 'is_delete','status as status_str','is_delete as is_delete_str'])
            ->toArray();

        return $result;


    }


    /**
     * 新增系统参数
     * @param $param
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/18/11:46 PM
     */
    public function store($param)
    {

        return System::query()->create($param);
    }


    /**
     * 修改系统参数
     * @param $where
     * @param $param
     * @return int
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/18/11:47 PM
     */
    public function update($where, $param)
    {
        return System::query()->where($where)->update($param);
    }


    /**
     * 删除系统参数
     * @param $where
     * @return int
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/18/11:48 PM
     */
    public function delSystem($where)
    {

        return System::query()->where($where)->update(['status' => 1]);
    }
}
