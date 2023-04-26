<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\AuthRoleService;
use App\Services\Common\CodeService;
use Illuminate\Http\Request;

class AuthRoleController extends Controller
{


    protected $authRoleService;


    public function __construct(AuthRoleService $service)
    {
        $this->authRoleService = $service;
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

        $list = $this->authRoleService->getList($param, ['*', 'status as status_str', 'is_delete as is_delete_str'], $page, $pageSize);

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

        $name         = $request->input('name');
        $status       = $request->input('status');

        if (empty($name) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['name']          = $name;
        $data['status']        = $status;
        $result = $this->authRoleService->store($data);

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
        $status   = $request->input('status');
        $id       = $request->input('id');
        if (empty($name)  || empty($id)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['name']      = $name;
        $data['status']    = $status;

        $result = $this->authRoleService->update(['id' => $id], $data);

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

        $result = $this->authRoleService->del(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }
}
