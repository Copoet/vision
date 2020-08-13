<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/13/10:09 AM
 */

namespace App\Services;

use App\Models\Manager;

class ManagerService
{

    /**
     * 获取管理员信息
     * @param $name
     * @return array
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/13/1:11 PM
     */
    public function getManagerInfo($name)
    {
        $result = Manager::query()
            ->where('name', $name)
            ->where('status', 1)
            ->first(['uuid', 'status', 'password', 'token'])
            ->toArray();

        return $result;
    }


    /**
     * 更新操作
     * @param $data
     * @param $where
     * @return int
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/13/5:57 PM
     */
    public function save($data, $where)
    {

        $result = Manager::query()->where($where)->update($data);

        return $result;
    }


    /**
     * 检测token
     * @param $token
     * @return mixed
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/13/6:54 PM
     */
    public function checkManagerToken($token){

        $result = Manager::query()->where(['token'=>$token])->value('id');
        return $result;

    }
}