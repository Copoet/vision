<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/17/5:25 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Common\CodeService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{


    protected $userService;


    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }


    /**
     * 用户列表
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/26/2:28 PM
     */
    public function userList(Request $request)
    {

        $page     = $request->input('page') ? $request->input('page') : 1;
        $pageSize = $request->input('page_size') ? $request->input('page_size') : 20;
        $param    = $request->all();

        $list = $this->userService->getUsesList($param, $page, $pageSize);

        if ($list) {
            $this->returnSuccess($list);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }




}