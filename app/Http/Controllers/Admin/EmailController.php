<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Common\CodeService;
use App\Services\EmailService;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    protected $emailService;


    public function __construct(EmailService $service)
    {
        $this->emailService = $service;
    }


    /**
     * 获取列表
     * @param Request $request
     */
    public function emailList(Request $request)
    {
        $page     = $request->input('page') ? $request->input('page') : 1;
        $pageSize = $request->input('page_size') ? $request->input('page_size') : 20;
        $param    = $request->all();

        $list = $this->emailService->getList($param, '*', $page, $pageSize);

        if ($list) {

            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);

        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * 新增Email
     * @param Request $request
     *
     */
    public function createEmail(Request $request)
    {
        $name        = $request->input('title');
        $sortId      = $request->input('sort_id');
        $titlePic    = $request->input('titlepic');
        $status      = $request->input('status');
        $content     = $request->input('content');
        $keywords    = $request->input('keywords');
        $description = $request->input('description');
        $flag        = $request->input('flag');

        if (empty($name) || empty($content) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['title']       = $name;
        $data['sort_id']     = $sortId;
        $data['titlepic']    = $titlePic;
        $data['status']      = $status;
        $data['content']     = $content;
        $data['keywords']    = $keywords;
        $data['description'] = $description;
        $data['flag']        = $flag;

        $result = $this->emailService->store($data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * 更新Email
     * @param Request $request
     */
    public function updateEmail(Request $request)
    {
        $name        = $request->input('title');
        $sortId      = $request->input('sort_id');
        $titlePic    = $request->input('titlepic');
        $status      = $request->input('status');
        $content     = $request->input('content');
        $keywords    = $request->input('keywords');
        $description = $request->input('description');
        $flag        = $request->input('flag');
        $id          = $request->input('id');

        if (empty($id) || empty($name) || empty($url) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['title']       = $name;
        $data['sort_id']     = $sortId;
        $data['titlepic']    = $titlePic;
        $data['status']      = $status;
        $data['content']     = $content;
        $data['keywords']    = $keywords;
        $data['description'] = $description;
        $data['flag']        = $flag;

        $result = $this->emailService->update(['id' => $id], $data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }

    /**
     * 删除Email
     * @param Request $request
     *
     */
    public function delEmail(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $result = $this->emailService->del(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }

}