<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/28/5:48 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Common\CodeService;
use App\Services\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{

    protected $stockService;


    public function __construct(StockService $service)
    {
        $this->stockService = $service;
    }


    /**
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/28/7:18 PM
     */
    public function stockList(Request $request)
    {
        $page     = $request->input('page') ? $request->input('page') : 1;
        $pageSize = $request->input('page_size') ? $request->input('page_size') : 20;
        $param    = $request->all();

        $list = $this->stockService->getStockList($param, $page, $pageSize);

        if ($list) {

            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);

        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }
}