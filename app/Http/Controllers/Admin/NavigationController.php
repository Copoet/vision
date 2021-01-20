<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/22/5:36 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Common\CodeService;
use App\Services\NavigationService;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    protected $navService;


    public function __construct(NavigationService $service)
    {
        $this->navService = $service;
    }


    /**
     * 导航列表
     * @param Request $request
     *
     */
    public function navigationList(Request $request)
    {
        $page     = $request->input('page') ? $request->input('page') : 1;
        $pageSize = $request->input('page_size') ? $request->input('page_size') : 20;
        $param    = $request->all();

        $list = $this->navService->getNavigationList($param, ['*','status as status_str','is_delete as is_delete_str'], $page, $pageSize);

        if ($list) {
            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);

        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * 添加导航
     * @param Request $request
     */
    public function createNavigation(Request $request)
    {

        $name     = $request->input('name');
        $parentId = $request->input('parent_id');
        $url      = $request->input('url');
        $status   = $request->input('status');
        $path     = $request->input('path');

        if (empty($name) || empty($url) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $checkResult = $this->navService->getNavigation(['name' => $name], 'id');

        if ($checkResult) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_ALREADY_EXIST);
        }

        $data['name']      = $name;
        $data['parent_id'] = $parentId;
        $data['url']       = $url;
        $data['status']    = $status;
        $data['path']      = $path;

        $result = $this->navService->store($data);

        if ($result) {

            $this->returnSuccess($result);
        }

        $this->returnFail(CodeService::PUBLIC_ERROR);

    }


    /**
     * 导航栏更新
     * @param Request $request
     */
    public function updateNavigation(Request $request)
    {
        $name     = $request->input('name');
        $parentId = $request->input('parent_id');
        $url      = $request->input('url');
        $status   = $request->input('status');
        $path     = $request->input('path');
        $id       = $request->input('id');

        if (empty($name) || empty($url) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $checkResult = $this->navService->getNavigation(['name' => $name], 'id');

        if ($checkResult && $id !== $checkResult['id']) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_ALREADY_EXIST);
        }

        $data['name']      = $name;
        $data['parent_id'] = $parentId;
        $data['url']       = $url;
        $data['status']    = $status;
        $data['path']      = $path;


        $result = $this->navService->update(['id' => $id], $data);
        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * 导航栏删除
     * @param Request $request
     */
    public function delNavigation(Request $request)
    {

        $id = $request->input('id');

        if (empty($id)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $result = $this->navService->delNavigation(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }
}
