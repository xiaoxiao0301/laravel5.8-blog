<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login as LoginRequests;
use App\Model\Admins;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.login.login');
    }

    public function handleLogin(LoginRequests $request)
    {
        $data = $request->all();
        // 表单验证通过后
        $username = $data['username'];
        $password = $data['password'];
        $admins = Admins::where('username', '=', $username)->first();

        if (!$admins || !Hash::check($password, $admins->password)) {
            return back()->with(['msg' => '用户名或密码错误']);
        }

        session(['admins' => $admins]);
        session(['adminName' => $username]);
        return redirect('admin/index');
    }


    public function logout()
    {
        session()->flush();
        return redirect('admin/login');
    }



}
