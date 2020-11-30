<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/22/5:35 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Common\CodeService;
use App\Services\Common\CommonService;
use App\Services\ManagerService;
use Illuminate\Http\Request;

class ManagerController extends Controller
{


    protected $managerService;

    public function __construct(ManagerService $service)
    {

        $this->managerService = $service;
    }


    /**
     * 管理员列表
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/24/5:11 PM
     */
    public function managerList(Request $request)
    {

        $page     = $request->input('page') ? $request->input('page') : 1;
        $pageSize = $request->input('page_size') ? $request->input('page_size') : 20;

        $param = $request->all();

        $list = $this->managerService->getManagerList($param, $page, $pageSize);

        if ($list) {

            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);

        } else {

            $this->returnFail(CodeService::PUBLIC_ERROR);
        }


    }


    /**
     * 添加管理员
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/25/2:54 PM
     */
    public function createManager(Request $request)
    {

        $userName = $request->input('name');
        $passWord = $request->input('pass_word');
        $status   = $request->input('status');

        if (empty($userName) || empty($passWord) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $checkResult = $this->managerService->getManagerInfo($userName);

        if ($checkResult) {

            $this->returnFail(CodeService::PUBLIC_USERNAME_ALREADY_EXIST);
        }

        $data['name']     = $userName;
        $data['password'] = password_hash($passWord,PASSWORD_DEFAULT);
        $data['uuid']     = CommonService::getUuid();
        $data['status']   = $status;
        $data['up_ip']    = $request->getClientIp();

        $result = $this->managerService->store($data);

        if ($result) {
            $this->returnSuccess($result, CodeService::PUBLIC_SUCCESS);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * 更新管理员信息
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/25/4:00 PM
     */
    public function updateManager(Request $request)
    {

        $userName = $request->input('name');
        $passWord = $request->input('pass_word');
        $status   = $request->input('status');
        $uuid     = $request->input('uuid');

        if (empty($userName) || empty($passWord) || empty($status) || empty($uuid)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $managerInfo = $this->managerService->getManagerInfo($userName);

        if ($managerInfo && $uuid !== $managerInfo['uuid']) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_ALREADY_EXIST);
        }

        $date['name']     = $userName;
        $date['password'] = CommonService::generatePass($userName, $passWord);
        $date['status']   = $status;

        $result = $this->managerService->save($date, ['uuid' => $uuid]);

        if ($result) {

            $this->returnSuccess($result, CodeService::PUBLIC_SUCCESS);

        } else {

            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * 删除管理员
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/25/4:05 PM
     */
    public function delManager(Request $request)
    {

        $uuid = $request->input('uuid');

        if (empty($uuid)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $result = $this->managerService->delManager(['uuid' => $uuid]);

        if ($result) {

            $this->returnSuccess($result, CodeService::PUBLIC_SUCCESS);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


}