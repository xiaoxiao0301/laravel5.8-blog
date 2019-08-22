<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admins;
use Validator;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function change()
    {
        return view('admin.pass.change');
    }

    public function edits(Request $request)
    {
        $admins = session('admins');

        $validator = Validator::make($request->all(),[
            'password_o' => [
                'required',
                function($attribute, $value, $fail) use ($admins) {
                    if (!Hash::check($value, $admins->password)) {
                        $fail("旧密码输入错误");
                    }
                }
            ],
//            'password' => 'required|confirmed',  表单中需要有 password_confirmation
            'password' => 'required',
            'password_c' => 'required|same:password'
        ], [
            'password.required' => '新密码不能为空',
            'password_o.required' => '旧密码不能为空',
            'password_c.required' => '确认密码不能为空',
            'password_c.same' => '新密码与确认密码不一致'
        ])->validate();

        //密码验证通过了
        $updates = Admins::where('username', '=', $admins->username)->update(['password' => Hash::make($request->input('password'))]);
        if ($updates) {
            return back()->withErrors("密码修改成功");
        }

    }
}
