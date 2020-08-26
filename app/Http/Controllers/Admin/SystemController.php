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
use App\Services\SystemService;
use Illuminate\Http\Request;

class SystemController extends Controller
{

    protected $systemService;


    public function __construct(SystemService $service)
    {

        $this->systemService = $service;
    }


    /**
     * 系统参数列表
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/26/10:54 AM
     */
    public function systemList(Request $request)
    {
        $page     = $request->input('page') ? $request->input('page') : 1;
        $pageSize = $request->input('page_size') ? $request->input('page_size') : 20;
        $param    = $request->all();

        $list = $this->systemService->getSystemList($param, $page, $pageSize);

        if ($list) {
            $this->returnSuccess($list);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * 添加系统参数
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/26/11:03 AM
     */
    public function createSystem(Request $request)
    {
        $sysName    = $request->input('sys_name');
        $sysValue   = $request->input('sys_value');
        $sysExplain = $request->input('sys_explain');
        $sysType    = $request->input('sys_type');
        $status     = $request->input('status');

        if (empty($sysName) || empty($sysValue) || empty($sysExplain) || empty($sysType)) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $checkResult = $this->systemService->getSystem(['name' => $sysName]);

        if ($checkResult) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_ALREADY_EXIST);
        }

        $data['sys_name']    = $sysName;
        $data['sys_value']   = $sysValue;
        $data['sys_explain'] = $sysExplain;
        $data['sys_type']    = $sysType;
        $data['status']      = $status;

        $result = $this->systemService->store($data);

        if ($result) {

            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * 更新系统参数
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/26/11:13 AM
     */
    public function updateSystem(Request $request)
    {
        $sysName    = $request->input('sys_name');
        $sysValue   = $request->input('sys_value');
        $sysExplain = $request->input('sys_explain');
        $sysType    = $request->input('sys_type');
        $status     = $request->input('status');
        $id         = $request->input('id');

        if (empty($id) || empty($sysName) || empty($sysValue) || empty($sysExplain) || empty($sysType)) {

            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

        $checkResult = $this->systemService->getSystem(['sys_name' => $sysValue]);
        if ($checkResult) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_ALREADY_EXIST);
        }

        $data['sys_name']    = $sysName;
        $data['sys_value']   = $sysValue;
        $data['sys_explain'] = $sysExplain;
        $data['sys_type']    = $sysType;
        $data['status']      = $status;

        $result = $this->systemService->update(['id' => $id], $data);

        if ($result) {

            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * 删除系统参数
     * @param Request $request
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/26/11:15 AM
     */
    public function delSystem(Request $request)
    {

        $id = $request->input('id');

        if (empty($id)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $result = $this->systemService->delSystem(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


}