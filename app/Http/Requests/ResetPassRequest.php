<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassRequest extends FormRequest
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
            'old_password'          => 'required',
            'password'              => 'required|min:7',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu phải lớn hơn 7 kí tự.',
            'password_confirmation.required' => 'Vui lòng xác thực mật khẩu mới.',
            'password_confirmation.same' => 'Xác nhận mật khẩu và mật khẩu phải khớp.',
        ];
    }
}
