<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/17/5:12 PM
 */

namespace App\Services;


use App\Models\Users;

class UserService
{


    /**
     * 获取用户信息
     * @param $where
     * @return array
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/19/2:51 PM
     */
    public function getUsersInfo($where)
    {

        return Users::query()->where($where)
            ->get(['id', 'username', 'phone', 'email', 'uuid', 'reg_ip', 'password', 'up_time', 'last_time', 'status'])
            ->toArray();
    }


    /**
     * 获取用户信息列表
     * @param $param
     * @param $page
     * @param $pageSize
     * @return mixed
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/19/2:54 PM
     */
    public function getUsesList($param, $page, $pageSize)
    {
        $result['total'] = Users::query()
            ->where(function ($query) use ($param) {
                if (isset($param['keyWords'])) {
                    $query->where('username', 'like', '%' . $param['keyWords'] . '%');
                }
            })->count();

        $offset = ($page - 1) * $pageSize;

        $result['list'] = Users::query()->where(function ($query) use ($param) {
            if (isset($param['keyWords'])) {
                $query->where('username', 'like', '%' . $param['keyWords'] . '%');
            }
        })
            ->offset($offset)
            ->limit($pageSize)
            ->get(['id', 'username', 'phone', 'email', 'uuid', 'reg_ip', 'password', 'is_delete', 'create_time', 'update_time', 'last_time', 'status', 'reg_time'])
            ->toArray();

        return $result;
    }


    /**
     * 添加用户
     * @param $param
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/19/2:55 PM
     */
    public function store($param)
    {

        return Users::query()->create($param);
    }


    /**
     * 修改用户信息
     * @param $where
     * @param $param
     * @return int
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/19/2:56 PM
     */
    public function update($where, $param)
    {

        return Users::query()->where($where)->update($param);

    }


    /**
     * 删除用户信息
     * @param $where
     * @return int
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/19/2:57 PM
     */
    public function delUses($where)
    {
        return Users::query()->where($where)->update(['status' => 1]);
    }

}