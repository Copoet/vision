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
            ->get(['id', 'sys_name', 'sys_value', 'sys_explain', 'sys_type', 'addtime', 'update_time', 'status', 'is_delete'])
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
    public function getSystemList($where,$page,$pageSize){

        $result['total'] = System::query()->where(function ($query) use ($where) {
            if (isset($param['keyWords'])) {
                $query->where('sys_name', 'like' ,'%' . $where['keyWords'] . '%');
            }
        })->count();

        $offset = ($page - 1) * $pageSize;

        $result['list'] = System::query()
            ->where(function ($query) use ($where) {
                if (isset($where['keyWords'])) {
                    $query->where('sys_name','like' ,'%' . $where['keyWords'] . '%');
                }
            })
            ->offset($offset)
            ->limit($pageSize)
            ->get(['id', 'sys_name', 'sys_value', 'sys_explain', 'sys_type', 'addtime', 'update_time', 'status', 'is_delete'])
            ->toArray();

        return $result;


    }
}