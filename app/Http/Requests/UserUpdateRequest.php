<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $user = $this->user();
        return [
            'name' => ['required',
            'min:2',
            'max:12',
            Rule::unique('users')->ignore($user->id),
        ],
            'mobile' => 'nullable|digits:11',
        ];
    }

    public function messages(){
        return [
            'name.required' => '用户名不能为空',
            'name.min' => '用户名最少2个字符',
            'name.max' => '用户名长度最大12个字符',
            'name.unique' => '用户名已存在',
            'mobile.digits' => '手机号位数不正确',
        ];
    }
}
