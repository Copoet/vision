<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\AuthRolePermissionsService;
use App\Services\Common\CodeService;
use Illuminate\Http\Request;

class AuthRolePermissionsController extends Controller
{
    protected $authRolePermissionsService;


    public function __construct(AuthRolePermissionsService $service)
    {
        $this->authRolePermissionsService = $service;
    }


    /**
     * 获取列表
     * @param Request $request
     */
    public function list(Request $request)
    {
        $page     = $request->input('page') ? $request->input('page') : 1;
        $pageSize = $request->input('page_size') ? $request->input('page_size') : 20;
        $param    = $request->all();

        $list = $this->authRolePermissionsService->getList($param,['*','status as status_str','is_delete as is_delete_str'], $page, $pageSize);

        if ($list) {
            $this->returnSuccess($list);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * 添加操作
     * @param Request $request
     */
    public function create(Request $request)
    {
        $name    = $request->input('name');
        $action  = $request->input('action');
        $status  = $request->input('status');
        $groupId = $request->input('group_id');

        if (empty($name) || empty($groupId) || empty($action)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['group_id'] = $groupId;
        $data['name']     = $name;
        $data['status']   = $status;
        $data['action']   = $action;

        $result = $this->authRolePermissionsService->store($data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * 更新操作
     * @param Request $request
     */
    public function update(Request $request)
    {
        $name     = $request->input('name');
        $action   = $request->input('action');
        $status   = $request->input('status');
        $groupId  = $request->input('group_id');
        $isDelete = $request->input('group_id');
        $id       = $request->input('id');

        if (empty($name) || empty($groupId) || empty($action)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['group_id']  = $groupId;
        $data['name']      = $name;
        $data['status']    = $status;
        $data['action']    = $action;
        $data['id_delete'] = $isDelete;

        $result = $this->authRolePermissionsService->update(['id' => $id], $data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * 删除操作
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $result = $this->authRolePermissionsService->del(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }


    }
}
