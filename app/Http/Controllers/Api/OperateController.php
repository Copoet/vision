<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/11/6:50 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdvertisingOperate;
use App\Services\Common\CommonService;
use App\Services\MerchantAdvertisingService;
use Illuminate\Http\Request;
use App\Services\Common\CodeService;
use Illuminate\Support\Facades\DB;

class OperateController extends Controller
{

    protected $merchantAdvertising;

    protected $operate;

    public function __construct(MerchantAdvertisingService $merchantAdService)
    {
        $this->merchantAdvertising = $merchantAdService;
    }

    /**
     * 上传运营图片
     * @param Request $request
     */
    public function operate(Request $request)
    {

        $pointId    = $request->input('point_id');
        $urls       = $request->input('url');
        $merchantId = $request->input('merchant_id');
        if (empty($pointId) || empty($urls) || empty($merchantId)) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }
        $urlsArray = explode(',', $urls);
        $data      = [];
        foreach ($urlsArray as $key) {
            $temp['ad_image_url'] = $key;
            $temp['point_id']     = $pointId;
            $temp['create_time']  = date('Y-m-d H:i:s', time());
            $temp['update_time']  = date('Y-m-d H:i:s', time());
            $data[]               = $temp;
        }
        $result = DB::table('advertising_operate')->insert($data);
        if ($result) {
            $this->returnSuccess('', CodeService::PUBLIC_SUCCESS);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }

    /**
     * 后去运营图片
     * @param Request $request
     */
    public function getOperate(Request $request)
    {
        $pointId    = $request->input('point_id');
        $merchantId = $request->input('merchant_id');
        $page       = $request->input('page') ? $request->input('page') : 1;
        $pageSize   = $request->input('page_size') ? $request->input('page_size') : 999;
        if (empty($pointId) || empty($merchantId)) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }
        $param           = $request->all();
        $result['total'] = DB::table('advertising_operate')
            ->where(function ($query) use ($param) {
                if (isset($param['point_id'])) {
                    $query->where('point_id', $param['point_id']);
                }
            })->count();

        $offset         = ($page - 1) * $pageSize;
        $result['list'] = DB::table('advertising_operate')
            ->where(function ($query) use ($param) {
                if (isset($param['point_id'])) {
                    $query->where('point_id', $param['point_id']);
                }
            })
            ->offset($offset)
            ->limit($pageSize)
            ->get(['ad_image_url', 'status', 'create_time', 'update_time',])
            ->toArray();
        if ($result) {
            $this->returnSuccess($result, CodeService::PUBLIC_SUCCESS);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }

}
