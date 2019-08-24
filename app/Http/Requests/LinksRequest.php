<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinksRequest extends FormRequest
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
            'links_name' => 'required',
            'links_url' => 'required|url',
            'links_order' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'links_name.required' => '链接名称不能为空',
            'links_url.required' => '链接地址不能为空',
            'links_url.url' => '链接地址不合法',
            'links_order.required' => '链接排序不能为空',
        ];
    }
}
