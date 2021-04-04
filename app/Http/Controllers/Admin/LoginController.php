<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/11/6:50 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Common\CodeService;

class LoginController extends Controller
{

    /**
     * 登录
     * @param Request $request
     * @author copoet
     * Date: 2020/8/11/6:52 PM
     */
    public function login(Request $request)
    {

        $manager = resolve('App\Services\ManagerService');

        $name     = $request->input('name');
        $password = $request->input('password');
        if (empty($name) || empty($password)) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }
        $managerInfo = $manager->getManagerInfo(['name' => $name]);

        $token = auth()->attempt(['name' => $name, 'password' => $password], true);

        if ($token) {
            $update['up_ip']     = $request->getClientIp();
            $update['last_time'] = date('Y-m-d H:i:s', time());
            $loginResult         = $manager->save($update, ['uuid' => $managerInfo['uuid']]);


            if ($loginResult) {
                $data['access_token']      = $token;
                $data['token_type']        = 'bearer';
                $data['user']['id']        = auth()->user()->id;
                $data['user']['name']      = auth()->user()->name;
                $data['user']['last_time'] = auth()->user()->last_time;
                $this->returnSuccess($data, CodeService::PUBLIC_SUCCESS);
            } else {
                $this->returnFail(CodeService::PUBLIC_LOGIN_ERROR);

            }
        } else {
            $this->returnFail(CodeService::PUBLIC_LOGIN_ERROR);
        }


    }


    /**
     * 退出登录
     */
    public function logout()
    {

        auth()->logout();
        $this->returnSuccess(CodeService::PUBLIC_SUCCESS);

    }

}
