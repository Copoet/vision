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
use App\Services\ManagerService;
use Illuminate\Http\Request;

class ManagerController extends Controller
{


    /**
     * 管理员列表
     * @param Request $request
     * @param ManagerService $managerService
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/24/5:11 PM
     */
    public function managerList(Request $request, ManagerService $managerService)
    {

        $page     = $request->input('page') ? $request->input('page') : 1;
        $pageSize = $request->input('page_size') ? $request->input('page_size') : 20;

        $param = $request->all();

        $list = $managerService->getManagerList($param, $page, $pageSize);

        if ($list) {

            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);

        } else {

            $this->returnFail(CodeService::PUBLIC_ERROR);
        }


    }
}