<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigsRequest extends FormRequest
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
            'configs_title' => 'required',
            'configs_name' => 'required',
            'configs_content' => 'required',
            'configs_order' => 'required',
            'configs_tips' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'configs_title.required' => '配置项标题不能为空',
            'configs_name.required' => '配置项名称不能为空',
            'configs_content.required' => '配置项名称值不能为空',
            'configs_order.required' => '排序不能为空',
            'configs_tips.required' => '配置项说明不能为空',
        ];
    }
}
