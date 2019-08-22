<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|min:4',
            'password' => 'required|min:4|max:12',
            'code' => 'required|captcha'
        ];
    }


    public function messages()
    {
        return [
            'username.required' => '用户名不能为空',
            'password.required' => '密码不能为空',
            'username.min' => '用户名不能少于4个字符',
            'password.min' => '密码不能少于6个字符',
            'password.max' => '密码不能超过12个字符',
            'code.required' => '验证码不能为空',
            'code.captcha' => '请输入正确的验证码',
        ];
    }
}
