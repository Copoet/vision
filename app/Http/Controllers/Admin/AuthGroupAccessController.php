<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\AuthGroupAccessService;
use App\Services\Common\CodeService;
use Illuminate\Http\Request;

class AuthGroupAccessController extends Controller
{
    protected $authGroupAccessService;


    public function __construct(AuthGroupAccessService $service)
    {
        $this->authGroupAccessService= $service;
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

        $list = $this->authGroupAccessService->getList($param, $page, $pageSize);
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
    public function create(Request $request){



    }


    /**
     * 更新操作
     * @param Request $request
     */
    public function update(Request $request){

    }


    /**
     * 删除操作
     * @param Request $request
     */
    public function delete(Request $request){

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