<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/11/6:50 PM
 */

namespace App\Http\Controllers\Api;

use App\Services\AdvertisingPointService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MerchantAdvertisingService;

use App\Services\Common\CodeService;

class AdvertisingPointController extends Controller
{

    protected $pointService;

    protected $merchantAdvertising;

    public function __construct(AdvertisingPointService $service, MerchantAdvertisingService $merchantAdService)
    {
        $this->pointService        = $service;
        $this->merchantAdvertising = $merchantAdService;
    }

    /**
     * 获取点位列表
     * @param $param
     * @param $page
     * @param $pageSize
     * @return mixed
     * @author copoet
     */
    public function getPointData(Request $request)
    {

        $page       = $request->input('page') ? $request->input('page') : 1;
        $pageSize   = $request->input('page_size') ? $request->input('page_size') : 999;
        $merchantId = $request->input('merchant_id');
        if (empty($merchantId)) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }
        $param = $request->all();

        $list                       = $this->pointService->getList($param, $page, $pageSize);
        $merchantPoint              = $this->merchantAdvertising->getInfo(['merchant_id' => $merchantId]);
        $list['merchant_point']     = count($merchantPoint) ?? 0;
        $pointIds                   = array_column($list['list'], 'id');
        $userPoint                  = $this->merchantAdvertising->getList($param, $page, $pageSize);
        $userPointIds               = array_column($userPoint['list'], 'advertising_point_id');
        $list['surplus']            = count(array_diff($pointIds, $userPointIds)) ?? 0;
        $list['surplus_str']        = '剩余点位';
        $list['total_str']          = '点位总数';
        $list['merchant_point_str'] = '投放点位';
        $list['ratio_str']          = '投放占比';

        if ($list) {
            $this->returnSuccess($list);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }





}
