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
                if (isset($param['keyWords'])) {
                    $query->where('stock_name', 'like', '%' . $where['keyWords'] . '%');
                }
            })->count();

        $offset = ($page - 1) * $pageSize;

        $result['list'] = Stock::query()->where(function ($query) use ($where) {
            if (isset($param['keyWords'])) {
                $query->where('stock_name', 'like', '%' . $where['keyWords'] . '%');
            }
        })
            ->offset($offset)
            ->limit($pageSize)
            ->get($columns)
            ->toArray();

        return $result;

    }
}