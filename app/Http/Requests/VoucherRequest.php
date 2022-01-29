<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
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
            'name' => 'required|max:255|unique:vouchers',
            'percent' => 'required|min:1|max:100|numeric',
            'expiry' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên voucher.',
            'name.max' => 'Tên voucher không được dài quá 255 kí tự.',
            'name.unique' => 'Tên voucher này đã tồn tại',

            'percent.required' => 'Vui lòng nhập số phần trăm giảm.',
            'percent.min' => 'Số phần trăm giảm phải lớn hơn 1%.',
            'percent.max' => 'Số phần trăm giảm phải nhỏ hơn hoặc bằng 100%.',
            'percent.numeric' => 'Phần trăm giảm phải là số.',

            'expiry.required' => 'Vui lòng đặt hạn sử dụng cho Voucher.',
        ];
    }
}
