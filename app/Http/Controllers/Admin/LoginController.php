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
use App\Services\Common\Commonservice;

class LoginController extends Controller
{

    /**
     * 登录
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
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

        $managerInfo = $manager->getManagerInfo($name);

        $pass = Commonservice::generatePass($name, $password);

        if ($pass == $managerInfo['password']) {

            $token = Commonservice::generateToken();

            $update['up_ip']     = $request->getClientIp();
            $update['token']     = $token;
            $update['last_time'] = date('Y-m-d H:i:s', time());
            $loginResult         = $manager->save($update, ['uuid' => $managerInfo['uuid']]);
            if ($loginResult) {
                $data['token'] = $token;

                $this->returnSuccess($data, CodeService::PUBLIC_SUCCESS);
            } else {
                $this->returnFail(CodeService::PUBLIC_LOGIN_ERROR);

            }
        } else {
            $this->returnFail(CodeService::PUBLIC_LOGIN_ERROR);
        }


    }

}