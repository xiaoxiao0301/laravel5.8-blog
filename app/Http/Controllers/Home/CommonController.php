<?php

namespace App\Http\Controllers\Home;

use View;
use App\Model\Navs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function __construct()
    {
        $navs = Navs::orderBy('navs_order', 'asc')->get();

        View::share(['navs' => $navs]);

        // 底部版权信息,网站配置中
        $footer = config('web.web_copyright');
        View::share(['footer' => $footer]);

    }

}
