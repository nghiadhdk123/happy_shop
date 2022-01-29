<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'phone' => 'required|numeric',
            'role' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng yêu cầu nhập tên.',
            'name.max' => 'Tên quá dài ! Vui lòng nhập tên ngắn hơn < 255 kí tự.',

            'email.required' => 'Vui lòng yêu cầu nhập email.',
            'email.max' => 'Email quá dài ! Vui lòng nhập email ngắn hơn < 255 kí tự.',
            'email.email' => 'Email chưa đúng định dạng ! Vui lòng nhập lại.',
            'email.unique' => 'Email này đã tồn tại! Xin vui lòng nhập email khác.',

            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.numeric' => 'Số điện thoại phải là số ! Vui lòng nhập lại.',

            'role.required' => 'Vui lòng chọn quyền hạn cho người mới.',
        ];
    }
}
