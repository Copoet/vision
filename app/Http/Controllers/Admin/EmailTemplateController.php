<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Common\CodeService;
use App\Services\EmailTemplateService;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    protected $service;


    public function __construct(EmailTemplateService $service)
    {
        $this->service = $service;
    }


    /**
     * 获取列表
     * @param Request $request
     */
    public function articleList(Request $request)
    {
        $page     = $request->input('page') ? $request->input('page') : 1;
        $pageSize = $request->input('page_size') ? $request->input('page_size') : 20;
        $param    = $request->all();

        $list = $this->service->getArticleList($param, '*', $page, $pageSize);

        if ($list) {

            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);

        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * 新增文章
     * @param Request $request
     *
     */
    public function createArticle(Request $request)
    {
        $name    = $request->input('title');
        $status  = $request->input('status');
        $content = $request->input('content');

        if (empty($name) || empty($content) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['title']   = $name;
        $data['status']  = $status;
        $data['content'] = $content;

        $result = $this->service->store($data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * 更新文章
     * @param Request $request
     */
    public function updateArticle(Request $request)
    {
        $name    = $request->input('title');
        $status  = $request->input('status');
        $content = $request->input('content');
        $id      = $request->input('id');
        if (empty($name) || empty($content) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['title']   = $name;
        $data['status']  = $status;
        $data['content'] = $content;


        $result = $this->service->update(['id' => $id], $data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }

    /**
     * 删除文章
     * @param Request $request
     *
     */
    public function delArticle(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $result = $this->service->del(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }

}