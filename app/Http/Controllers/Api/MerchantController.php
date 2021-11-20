<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/11/6:50 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MerchantAdvertising;
use App\Services\Common\CommonService;
use App\Services\MerchantAdvertisingService;
use Illuminate\Http\Request;
use App\Services\Common\CodeService;

class MerchantController extends Controller
{

    /**
     * 商户信息
     * @param Request $request
     * @author copoet
     * Date: 2020/8/11/6:52 PM
     */
    public function info(Request $request)
    {

        $merchant = resolve('App\Services\MerchantService');
        $phone    = $request->input('phone');
        $password = $request->input('password');
        if (empty($phone) || empty($password)) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }
        $merchantInfo = $merchant->getMerchantInfo(['phone' => $phone]);

        if (empty($merchantInfo)) {
            $this->returnFail(CodeService::PUBLIC_LOGIN_ERROR);
        }
        if ($merchantInfo['password'] == $password) {
            $update['last_ip']   = $request->getClientIp();
            $update['last_time'] = date('Y-m-d H:i:s', time());
            $loginResult         = $merchant->save($update, ['id' => $merchantInfo['id']]);
            if ($loginResult) {
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
            } else {
                $this->returnFail(CodeService::PUBLIC_LOGIN_ERROR);

            }
        } else {
            $this->returnFail(CodeService::PUBLIC_LOGIN_ERROR);
        }


    }



}
