<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\AuthPermissionsService;
use App\Services\Common\CodeService;
use Illuminate\Http\Request;

class AuthPermissionsController extends Controller
{
    protected $authPermissionsService;


    public function __construct(AuthPermissionsService $service)
    {
        $this->authPermissionsService = $service;
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

        $list = $this->authPermissionsService->getList($param,['*','status as status_str','is_delete as is_delete_str'], $page, $pageSize);
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
        $id      = $request->input('id');
        $uid     = $request->input('uid');
        $groupId = $request->input('group_id');

        if (empty($name) || empty($groupId)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }


        $data['id']       = $id;
        $data['uid']      = $uid;
        $data['group_id'] = $groupId;

        $result = $this->authPermissionsService->store($data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }


    }


    /**
     * 更新操作
     * @param int $id
     * @param Request $request
     */
    public function update(int $id,Request $request)
    {

        $uid     = $request->input('uid');
        $groupId = $request->input('group_id');

        if (empty($name) || empty($groupId)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }


        $data['id']       = $id;
        $data['uid']      = $uid;
        $data['group_id'] = $groupId;

        $result = $this->authPermissionsService->update($data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * 删除操作
     * @param int $id
     */
    public function delete(int $id)
    {

        $result = $this->authPermissionsService->del(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }
}
