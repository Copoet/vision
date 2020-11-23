<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\AuthRuleService;
use App\Services\Common\CodeService;
use Illuminate\Http\Request;

class AuthRuleController extends Controller
{


    protected $authRuleService;


    public function __construct(AuthRuleService $service)
    {
        $this->authRuleService = $service;
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

        $list = $this->authRuleService->getList($param, $page, $pageSize);

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

        $menuId = $request->input('menu_id');
        $action = $request->input('action');
        $name   = $request->input('name');
        $status = $request->input('status');

        if (empty($name) || empty($menuId) || empty($action)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['menu_id'] = $menuId;
        $data['name']    = $name;
        $data['status']  = $status;
        $data['action']  = $action;

        $result = $this->authRuleService->store($data);

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
        $menuId   = $request->input('menu_id');
        $action   = $request->input('action');
        $name     = $request->input('name');
        $status   = $request->input('status');
        $id       = $request->input('id');
        $isDelete = $request->input('is_delete');

        if (empty($name) || empty($menuId) || empty($action) || empty($id)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['menu_id']   = $menuId;
        $data['name']      = $name;
        $data['status']    = $status;
        $data['action']    = $action;
        $data['is_delete'] = $isDelete;

        $result = $this->authRuleService->update(['id' => $id], $data);

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

        $result = $this->authRuleService->del(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }
}