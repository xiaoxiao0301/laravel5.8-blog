<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index.index');
    }

    public function info()
    {
        $data = [
            'os' => PHP_OS,
            'environment' => $_SERVER['SERVER_SOFTWARE'],
            'version' => phpversion(),
            'domain' => $_SERVER['HTTP_HOST'],
            'ip' =>gethostbyname($_SERVER['SERVER_NAME']),
            'fileUpload' => get_cfg_var("upload_max_filesize")??"不允许上传附件"

        ];
        return view('admin.index.info')->with(['data' => $data]);
    }
}
