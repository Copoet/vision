<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/28/5:49 PM
 */

namespace App\Services;


use App\Models\Stock;

class StockService
{


    /**
     * 列表
     * @param $where
     * @param array $columns
     * @param $page
     * @param $pageSize
     * @return mixed
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/28/7:16 PM
     */
    public function getStockList($where, $columns = ['*'], $page, $pageSize)
    {

        $result['total'] = Stock::query()
            ->where(function ($query) use ($where) {
                if (isset($param['keyword'])) {
                    $query->where('stock_name', 'like', '%' . $where['keyWords'] . '%');
                }
            })->count();

        $offset = ($page - 1) * $pageSize;

        $result['list'] = Stock::query()->where(function ($query) use ($where) {
            if (isset($param['keyword'])) {
                $query->where('stock_name', 'like', '%' . $where['keyWords'] . '%');
            }
        })
            ->offset($offset)
            ->limit($pageSize)
            ->get($columns)
            ->toArray();

        return $result;

    }


    /**
     * 保存记录
     * @param $param
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/9/2/4:06 PM
     */
    public function store($param)
    {
        return Stock::query()->create($param);
    }


    /**
     * 更新记录
     * @param $where
     * @param $param
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/9/2/4:07 PM
     */
    public function update($where, $param)
    {
        return Stock::query()->where($where)->update($param);
    }


    /**
     * 删除记录
     * @param $where
     * @param $param
     * @return int
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/9/2/4:09 PM
     */
    public function delete($where)
    {
        return Stock::query()->where($where)->update(['status'=>1]);
    }
}