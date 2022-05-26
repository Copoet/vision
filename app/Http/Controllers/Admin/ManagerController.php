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


    public function managerInfo(int $id)
    {
        if (empty($id)) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data = $this->managerService->getManagerInfo(['id' => $id]);

        if ($data) {

            $this->returnSuccess($data, CodeService::PUBLIC_SUCCESS);
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
        $passWord = $request->input('password');
        $status   = $request->input('status');

        if (empty($userName) || empty($passWord) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $checkResult = $this->managerService->getManagerInfo(['name' => $userName]);

        if ($checkResult) {

            $this->returnFail(CodeService::PUBLIC_USERNAME_ALREADY_EXIST);
        }

        $data['name']     = $userName;
        $data['password'] = password_hash($passWord, PASSWORD_DEFAULT);
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
     * @param int $id
     * @param Request $request
     */
    public function updateManager(Request $request)
    {

        $userName = $request->input('name');
        $id       = $request->input('id');
        $passWord = $request->input('password');
        $status   = $request->input('status');

        if (empty($userName) || empty($status) || empty($id)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $managerInfo = $this->managerService->getManagerInfo(['name'=>$userName]);
        if ($managerInfo && $id != $managerInfo['id']) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_ALREADY_EXIST);
        }

        if (!empty($passWord)) {
            $data['password'] = password_hash($passWord, PASSWORD_DEFAULT);
        }


        $data['name']   = $userName;
        $data['status'] = $status;

        $result = $this->managerService->save($data, ['id' => $id]);

        if ($result) {

            $this->returnSuccess($result, CodeService::PUBLIC_SUCCESS);

        } else {

            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * 删除管理员
     * @param int $id
     */
    public function delManager(int $id)
    {


        if (empty($id)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $result = $this->managerService->delManager(['id' => $id]);

        if ($result) {

            $this->returnSuccess($result, CodeService::PUBLIC_SUCCESS);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


}
