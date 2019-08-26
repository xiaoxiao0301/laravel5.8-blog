<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NavsRequest extends FormRequest
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
            'navs_name' => 'required',
            'navs_alias' => 'required',
            'navs_url' => 'required',
            'navs_order' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'navs_name.required' => '导航名称不能为空',
            'navs_alias.required' => '导航名称不能为空',
            'navs_url.required' => '导航地址不能为空',
            'navs_order.required' => '导航排序不能为空',
        ];
    }
}
