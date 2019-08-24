<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Articles extends FormRequest
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
            'art_title' => 'required',
            'art_tag' => 'required',
            'art_description' => 'required',
            'art_author' => 'required',
            'art_thumb' => 'required',
            'art_content' => 'required',
            'art_cate_id' => 'required',
        ];
    }

    public function merge(array $input)
    {
        return [
            'art_title.required' => '文章题目不能为空',
            'art_tag.required' => '文章关键字不能为空',
            'art_description.required' => '文章描述不能为空',
            'art_author.required' => '文章作者不能为空',
            'art_thumb.required' => '文章缩略图不能为空',
            'art_content.required' => '文章内容不能为空',
            'art_cate_id.required' => '文章分类不能为空',
        ];

    }
}
