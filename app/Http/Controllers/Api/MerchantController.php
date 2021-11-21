<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/11/6:50 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Common\CommonService;
use App\Services\MerchantAdvertisingService;
use Illuminate\Http\Request;
use App\Services\Common\CodeService;

class MerchantController extends Controller
{
    protected $pointService;

    protected $merchantAdvertising;

    public function __construct(MerchantAdvertisingService $merchantAdService)
    {
        $this->merchantAdvertising = $merchantAdService;
    }


    /**
     * 商户信息
     * @param Request $request
     * @author copoet
     * Date: 2020/8/11/6:52 PM
     */
    public function merchantInfo(Request $request)
    {
        $merchant = resolve('App\Services\MerchantService');
        $merchantId   = $request->input('merchant_id');
        if (empty($merchantId)) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }
        $merchantInfo = $merchant->getMerchantInfo(['id' => $merchantId]);
        if (empty($merchantInfo)) {
            $this->returnFail(CodeService::PUBLIC_LOGIN_ERROR);
        }
        //获取投放数量
        $totalPoint              = (new MerchantAdvertisingService())->getInfo(['merchant_id' => $merchantInfo['id']], ['id']);
        $data['merchant_id']     = $merchantInfo['id'];
        $data['name']            = $merchantInfo['name'];
        $data['phone']           = $merchantInfo['phone'];
        $data['create_time']     = $merchantInfo['create_time'];
        $data['expiration_time'] = $merchantInfo['expiration_time'];
        $data['token']           = CommonService::generateToken();
        $data['total_point']     = count($totalPoint) ?? 0;
        $data['join_day']        = intval((strtotime(date('Y-m-d H:i:s'))-strtotime($merchantInfo['create_time']))/86400);
        $this->returnSuccess($data, CodeService::PUBLIC_SUCCESS);

    }

    /**
     * 获取商户点位信息
     * @param Request $request
     */
    public function getMerchantPoint(Request $request)
    {
        $page       = $request->input('page') ? $request->input('page') : 1;
        $pageSize   = $request->input('page_size') ? $request->input('page_size') : 999;
        $merchantId = $request->input('merchant_id');
        if (empty($merchantId)) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }
        $param = $request->all();
        $list  = $this->merchantAdvertising->getMerchantAdvertising($param, $page, $pageSize);
        if ($list) {
            $this->returnSuccess($list);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }

}
