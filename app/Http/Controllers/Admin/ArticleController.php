<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\Common\CodeService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{


    protected $articleService;


    public function __construct(ArticleService $service)
    {
        $this->articleService = $service;
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

        $list = $this->articleService->getArticleList($param, ['*', 'status as status_str', 'is_delete as is_delete_str'], $page, $pageSize);

        if ($list) {

            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);

        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }

    /**
     * 获取文章详情
     * @param int $id
     */
    public function articleInfo(int $id)
    {
        if (empty($id)) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data = $this->articleService->getArticleInfo(['id' => $id]);

        if ($data) {

            $this->returnSuccess($data, CodeService::PUBLIC_SUCCESS);
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

        $result = $this->articleService->store($data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * 更新文章
     * @param int $id
     * @param Request $request
     */
    public function updateArticle(int $id, Request $request)
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

        $result = $this->articleService->update(['id' => $id], $data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }

    /**
     * 删除文章
     * @param int $id
     *
     */
    public function delArticle(int $id)
    {
        $result = $this->articleService->del(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }

}
