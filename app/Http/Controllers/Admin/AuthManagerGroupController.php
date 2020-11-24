<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AuthManagerGroupService;
use App\Services\Common\CodeService;
use Illuminate\Http\Request;

class AuthManagerGroupController extends Controller
{
    protected $authManagerGroup;


    public function __construct(AuthManagerGroupService $service)
    {
        $this->authManagerGroup = $service;
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

        $list = $this->authManagerGroup->getList($param, $page, $pageSize);

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
        $name        = $request->input('name');
        $status      = $request->input('status');
        $description = $request->input('description');

        if (empty($name) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }


        $data['group_name']  = $name;
        $data['description'] = $description;
        $data['status']      = $status;

        $result = $this->authManagerGroup->store($data);

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
        $name        = $request->input('name');
        $status      = $request->input('status');
        $description = $request->input('description');
        $id          = $request->input('id');

        if (empty($name) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['group_name']  = $name;
        $data['description'] = $description;
        $data['status']      = $status;

        $result = $this->authManagerGroup->update(['id' => $id], $data);

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

        $result = $this->authManagerGroup->del(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }
}