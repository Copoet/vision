<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/11/6:50 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Common\CodeService;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    /**
     * 上传图片
     * @param Request $request
     * @author copoet
     * Date: 2020/8/11/6:52 PM
     */
    public function uploadImage(Request $request)
    {

        if (!$request->hasFile('file')) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }
        $picture = $request->file('file');
        $extension = $picture->getClientOriginalExtension();

        $newPictureName = date('His') . '-' . mt_rand(1000, 9999) . '.' . $extension;
        $savePath = 'images/' . date('Ym');
        Storage::disk('public')->makeDirectory($savePath);
        $filePath = $savePath . '/' . $newPictureName;
        if($picture->storePubliclyAs($savePath, $newPictureName, ['disk' => 'public'])){

            $this->returnSuccess($request->server('HTTP_HOST').'/storage/'.$filePath, CodeService::PUBLIC_SUCCESS);
        }
        $this->returnFail(CodeService::PUBLIC_ERROR);
    }



}
