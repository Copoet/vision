<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/13/10:09 AM
 */

namespace App\Services;

use App\Models\AdvertisingPoint;

class AdvertisingPointService
{


    public function getInfo($where, $columns = ['*'])
    {
        return AdvertisingPoint::query()->where($where)->get($columns)->toArray();
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

        $result = AdvertisingPoint::query()->where($where)->update($data);

        return $result;
    }


    /**
     * 获取列表
     * @param $param
     * @param $page
     * @param $pageSize
     * @return mixed
     * @author copoet
     * @mail copoet@126.com
     */
    public function getList($param, $page, $pageSize)
    {
        $result['total'] = AdvertisingPoint::query()
            ->where(function ($query) use ($param) {
                if (isset($param['keyword'])) {
                    $query->where('name', 'like', '%' . $param['keyword'] . '%');
                }
            })->count();

        $offset = ($page - 1) * $pageSize;

        $result['list'] = AdvertisingPoint::query()->where(function ($query) use ($param) {
            if (isset($param['keyword'])) {
                $query->where('name', 'like', '%' . $param['keyword'] . '%');
            }
        })
            ->offset($offset)
            ->limit($pageSize)
            ->get(['id', 'name', 'type', 'image_url', 'longitude', 'latitude'])
            ->toArray();

        return $result;
    }

    /**
     *
     * @param $param
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/25/3:00 PM
     */
    public function store($param)
    {
        return AdvertisingPoint::query()->forceCreate($param);
    }


    /**
     * @param $where
     * @return int
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/25/4:03 PM
     */
    public function delete($where)
    {
        return AdvertisingPoint::query()->where($where)->update(['is_delete' => 1]);
    }
}
