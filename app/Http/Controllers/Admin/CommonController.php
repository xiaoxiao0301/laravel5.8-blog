<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function fileUpload(Request $request)
    {
        $file = $request->file('file');

        $allowed_extensions = ["png", "jpg", "gif", "jpeg", "bmp"];

        if ($file->getClientOriginalName() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            $data = [
                'status' => -1,
                'msg' => '文件类型错误'
            ];

        }

        $savePath = 'uploader/articles';
        if (!file_exists($savePath) || !is_dir($savePath)) {
            mkdir($savePath, 0755, true);
        } else {
            $extension = $file->getClientOriginalExtension(); // 文件后缀
            $filePath = $savePath.'/'.date('Y-m-d', time()).'/';
            $fileName = md5(uniqid()).'.'.$extension;
            $file->move($filePath, $fileName);
            $newFilePath = '/'.$filePath.$fileName;
            $data = [
                'status' => 1,
                'fileName' => $newFilePath
            ];
        }

        return response()->json($data);

    }
}
