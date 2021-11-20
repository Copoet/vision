<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/13/10:09 AM
 */

namespace App\Services;

use App\Models\MerchantAdvertising;

class MerchantAdvertisingService
{


    public function getInfo($where, $columns = ['*'])
    {
        return MerchantAdvertising::query()->where($where)->get($columns)->toArray();
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

        $result = MerchantAdvertising::query()->where($where)->update($data);

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
        $result['total'] = MerchantAdvertising::query()
            ->where(function ($query) use ($param) {
                if (isset($param['keyword'])) {
                    $query->where('merchant_id', 'like', '%' . $param['keyword'] . '%');
                }
            })->count();

        $offset = ($page - 1) * $pageSize;

        $result['list'] = MerchantAdvertising::query()->where(function ($query) use ($param) {
            if (isset($param['keyword'])) {
                $query->where('merchant_id', 'like', '%' . $param['keyword'] . '%');
            }
        })
            ->offset($offset)
            ->limit($pageSize)
            ->get(['id', 'merchant_id', 'advertising_point_id', 'begin_time', 'end_time', 'create_time', 'update_time', 'is_delete',])
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
        return MerchantAdvertising::query()->forceCreate($param);
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
        return MerchantAdvertising::query()->where($where)->update(['is_delete' => 1]);
    }

    public function getMerchantAdvertising($param, $page, $pageSize)
    {
        $result['total'] = MerchantAdvertising::query()
            ->withCount(['advertisingPoint:name as name'])
            ->where(function ($query) use ($param) {
                if (isset($param['keyword'])) {
                    $query->where('advertisingPoint:name', 'like', '%' . $param['keyword'] . '%');
                }
                if (isset($param['merchant_id'])) {
                    $query->where('merchant_id',$param['merchant_id'] );
                }
            })->count();
        dd($result);
        $offset = ($page - 1) * $pageSize;

        $result['list'] = MerchantAdvertising::query()->where(function ($query) use ($param) {
            if (isset($param['keyword'])) {
                $query->where('advertisingPoint:name', 'like', '%' . $param['keyword'] . '%');
            }
        })
            ->with(['advertisingPoint:id,name,mage_url,type'])
            ->offset($offset)
            ->limit($pageSize)
            ->get(['id', 'merchant_id', 'advertising_point_id', 'begin_time', 'end_time', 'create_time', 'update_time', 'is_delete',])
            ->toArray();

        return $result;
    }

}
