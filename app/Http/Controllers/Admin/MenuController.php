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
use http\Env\Request;


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

        $list = $this->menuService->getAllMenu();
        $list = CommonService::getTree($list, 0);
        $queue = array('id' => 0, 'label' => '顶级菜单', 'parent_id' => 0);
        array_unshift($list, $queue);

        if ($list) {

            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);
        } else {

            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


}