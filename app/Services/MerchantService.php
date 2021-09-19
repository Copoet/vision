<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/13/10:09 AM
 */

namespace App\Services;

use App\Models\Merchant;
use App\Models\MerchantAdvertising;

class MerchantService
{

    /**
     * 获取商户信息
     * @param $where
     * @param $columns
     * @return array
     */


    public function getMerchantInfo($where, $columns = ['*'])
    {
        return Merchant::query()->where($where)->get($columns)->first();
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

        $result = Merchant::query()->where($where)->update($data);

        return $result;
    }




    /**
     * @param $where
     * @param $page
     * @param $pageSize
     * @param array $columns
     * @return mixed
     * @author copoet
     * @mail copoet@126.com
     */
    public function getManagerList($where, $page, $pageSize, $columns = ['*', 'status as status_str', 'is_delete as is_delete_str'])
    {

        $where['is_delete'] = 2;
        $result['total']    = Merchant::query()
            ->where(function ($query) use ($where) {
                if (isset($where['keyword'])) {
                    $query->where('name', 'like', '%' . $where['keyword'] . '%');
                }
                if (isset($where['is_delete'])) {
                    $query->where('is_delete', $where['is_delete']);
                }
            })->count();

        $offset = ($page - 1) * $pageSize;

        $result['list'] = Merchant::query()->where(function ($query) use ($where) {
            if (isset($where['keyword'])) {
                $query->where('name', 'like', '%' . $where['keyword'] . '%');
            }
            if (isset($where['is_delete'])) {
                $query->where('is_delete', $where['is_delete']);
            }
        })
            ->offset($offset)
            ->limit($pageSize)
            ->get($columns)
            ->toArray();

        return $result;

    }


    /**
     * 添加管理员
     * @param $param
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/25/3:00 PM
     */
    public function store($param)
    {
        return Merchant::query()->forceCreate($param);
    }


    /**
     * 删除
     * @param $where
     * @return int
     * @author copoet
     * @mail copoet@126.com
     */
    public function delete($where)
    {
        return Merchant::query()->where($where)->update(['is_delete' => 1]);
    }



}
