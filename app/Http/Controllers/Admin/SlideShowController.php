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
use App\Services\SlideShowService;
use Illuminate\Http\Request;

class SlideShowController extends Controller
{

    protected $slideService;


    public function __construct(SlideShowService $service)
    {
        $this->slideService = $service;
    }


    /**
     *轮播列表
     * @param Request $request
     *
     */
    public function slideList(Request $request)
    {
        $page     = $request->input('page') ? $request->input('page') : 1;
        $pageSize = $request->input('page_size') ? $request->input('page_size') : 20;
        $param    = $request->all();

        $list = $this->slideService->getSlideList($param, ['*', 'status as status_str', 'is_delete as is_delete_str'], $page, $pageSize);

        if ($list) {
            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);

        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }

    /**
     * 获取轮播图信息
     * @param int $id
     */
    public function slideInfo(int $id)
    {

        if (empty($id)) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data = $this->slideService->getSlideShow(['id' => $id]);

        if ($data) {

            $this->returnSuccess($data, CodeService::PUBLIC_SUCCESS);
        } else {

            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * 创建轮播
     * @param Request $request
     */
    public function createSlide(Request $request)
    {

        $name    = $request->input('name');
        $url     = $request->input('url');
        $status  = $request->input('status');
        $pic     = $request->input('pic');
        $remark  = $request->input('remark');
        $myorder = $request->input('myorder');

        if (empty($name) || empty($url) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $checkResult = $this->slideService->getSlideShow(['name' => $name], 'id');

        if ($checkResult) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_ALREADY_EXIST);
        }

        $data['name']    = $name;
        $data['url']     = $url;
        $data['status']  = $status;
        $data['pic']     = $pic;
        $data['remark']  = $remark;
        $data['myorder'] = $myorder;

        $result = $this->slideService->store($data);

        if ($result) {

            $this->returnSuccess($result);
        }

        $this->returnFail(CodeService::PUBLIC_ERROR);

    }


    /**
     * 轮播修改
     * @param int $id
     * @param Request $request
     */
    public function updateSlide(int $id, Request $request)
    {
        $name    = $request->input('name');
        $url     = $request->input('url');
        $status  = $request->input('status');
        $pic     = $request->input('pic');
        $remark  = $request->input('remark');
        $myorder = $request->input('myorder');

        if (empty($name) || empty($url) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $checkResult = $this->slideService->getSlideShow(['name' => $name], 'id');

        if ($checkResult && $id !== $checkResult['id']) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_ALREADY_EXIST);
        }

        $data['name']    = $name;
        $data['url']     = $url;
        $data['status']  = $status;
        $data['pic']     = $pic;
        $data['remark']  = $remark;
        $data['myorder'] = $myorder;


        $result = $this->slideService->update(['id' => $id], $data);
        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * 轮播删除
     * @param int $id
     */
    public function delSlide(int $id)
    {

        $result = $this->slideService->delSlide(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }

}
