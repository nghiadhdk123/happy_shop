<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'phone' => 'required|numeric',
            'role' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng yêu cầu nhập tên',
            'name.max' => 'Tên quá dài ! Vui lòng nhập tên ngắn hơn < 255 kí tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại phải là số ! Vui lòng nhập lại',
            'role.required' => 'Vui lòng chọn quyền hạn cho người mới',
        ];
    }
}
