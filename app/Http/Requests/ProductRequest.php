<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:255|unique:products,name',
            'origin_price' => 'required|numeric|max:100000000|min:1000|lt:sale_price',
            'sale_price' => 'required|numeric|max:100000000|min:1000',
            'quantity' => 'required|min:0|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => 'Vui lòng nhập tên sản phẩm.',
            'name.max'                  => 'Tên sản phẩm không được nhập quá :max ký tự.',
            'name.unique'               => 'Tên sản phẩm này đã tồn tại trong kho.',

            'origin_price.required'     => 'Vui lòng nhập giá gốc của sản phẩm.',
            'origin_price.numeric'      => 'Giá của sản phẩm phải nhập số.',
            'origin_price.max'          => 'Giá của sản phẩm không nhập quá :max.',
            'origin_price.min'          => ' Giá của sản phẩm không nhỏ hơn :min.',
            'origin_price.lt'             => 'Giá gốc của sản phẩm phải nhỏ hơn giá bán của sản phẩm.',

            'sale_price.required'       => 'Vui lòng nhập giá giảm của sản phẩm.',
            'sale_price.numeric'        => 'Giá của sản phẩm phải nhập số.',
            'sale_price.max'            => 'Giá của sản phẩm không nhập quá :max.',
            'sale_price.min'            => 'Giá của sản phẩm không nhỏ quá :min.',
            

            'quantity.required'        => 'Vui lòng nhập số lượng sản phẩm.',
            'quantity.min'        => 'Số lượng sản phẩm phải lớn hơn :min.',
            'quantity.numeric'        => 'Số lượng sản phẩm phải là số.',
        ];
    }
}
