<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/17/5:35 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Common\CodeService;
use App\Services\Common\CommonService;
use App\Services\MenuService;
use Illuminate\Http\Request;


class MenuController extends Controller
{


    protected $menuService;


    public function __construct(MenuService $service)
    {
        $this->menuService = $service;
    }


    /**
     * 获取菜单列表
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/25/5:22 PM
     */
    public function menuList(Request $request)
    {

        $page     = $request->input('page') ? $request->input('page') : 1;
        $pageSize = $request->input('page_size') ? $request->input('page_size') : 20;
        $param    = $request->all();

        $list = $this->menuService->getMenuList($param, $page, $pageSize);

        if ($list) {

            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);

        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * 获取树形结构菜单
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/25/7:06 PM
     */
    public function menuTree()
    {

        $list  = $this->menuService->getAllMenu();
        $list  = CommonService::getTree($list, 0);
        $queue = array('id' => 0, 'label' => '顶级菜单', 'parent_id' => 0);
        array_unshift($list, $queue);

        if ($list) {

            $this->returnSuccess($list);
        } else {

            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * 创建菜单
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/26/10:09 AM
     */
    public function createMenu(Request $request)
    {
        $name     = $request->input('name');
        $parentId = $request->input('parent_id');
        $url      = $request->input('url');
        $status   = $request->input('status');
        $icon     = $request->input('icon');

        if (empty($name) || empty($url) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $checkResult = $this->menuService->getMenuInfo(['name' => $name], 'id');

        if ($checkResult) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_ALREADY_EXIST);
        }

        $data['name']      = $name;
        $data['parent_id'] = $parentId;
        $data['url']       = $url;
        $data['status']    = $status;
        $data['icon']      = $icon;

        $result = $this->menuService->store($data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * 菜单更新
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/26/10:43 AM
     */
    public function updateMenu(Request $request)
    {
        $name     = $request->input('name');
        $parentId = $request->input('parent_id');
        $url      = $request->input('url');
        $status   = $request->input('status');
        $icon     = $request->input('icon');
        $id       = $request->input('id');

        if (empty($id) || empty($name) || empty($url) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }


        $checkResult = $this->menuService->getMenuInfo(['name' => $name], ['id', 'name']);

        if ($checkResult && $id !== $checkResult['id']) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_ALREADY_EXIST);
        }

        $data['name']      = $name;
        $data['parent_id'] = $parentId;
        $data['url']       = $url;
        $data['status']    = $status;
        $data['icon']      = $icon;

        $result = $this->menuService->updateMenu(['id' => $id], $data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }


    }


    /**
     * 菜单删除
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/26/10:47 AM
     */
    public function delMenu(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $result = $this->menuService->delMenu(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * 获取侧边栏菜单
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/9/2/10:19 AM
     */
    public function sideMenu(){

        $list = $this->menuService->getSideMenu();

        $result = CommonService::getTree($list, 0);

        if($result){

            $this->returnSuccess($result);
        }else{
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }

}