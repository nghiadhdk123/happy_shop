<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:1|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|numeric',
            'password' => 'required|min:7',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Tên không được phép bỏ trống.',
            'name.min' => 'Tên phải lớn hơn 1 kí tự.',
            'name.max' => 'Tên không được dài quá 255 kí tự.',

            'email.email' => 'Email chưa đúng định dạng.',
            'email.max' => 'Email không được dài quá 255 kí tự.',
            'email.required' => 'Email không được phép bỏ trống.',
            'email.unique' => 'Email đã tồn tại ! Xin hãy nhập email khác.',
            
            'phone.required' => 'Số điện thọai không được phép bỏ trống.',
            'phone.numeric' => 'Số điện thoại phải là số.',

            'password.required' => 'Mật khẩu không được phép bỏ trống.',
            'password.min' => 'Mật khẩu phải lớn hơn 7 kí tự.'
        ];
    }
}
