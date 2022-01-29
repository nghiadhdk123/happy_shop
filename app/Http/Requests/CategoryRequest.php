<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        // $id = $this->route('category')->id;
        return [
            'name' => "required|max:255|unique:categories,name, $this->id",
            'parent_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.max' => 'Tên danh mục quá dài ! Vui lòng nhập tên ngắn hơn < 255 kí tự',
            'name.unique' => 'Tên danh mục đã tồn tại ! Vui lòng nhập tên khác',

            'parent_id.required' => 'Vui lòng chọn danh mục cha',
        ];
    }
}
