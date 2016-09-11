<?php

namespace App\Http\Requests\ItemCategories;

use App\Http\Requests\Request;

class UpdateItemCategoryRequest extends Request
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
      $category = $this->route()->parameter('category');

      return [
        'category' => 'required|unique:item_categories,category,'.$category->id,
      ];
    }

    /**
     * Custom error messages for fields
     *
     * @return array
     */
    public function messages()
    {
      return [
        'category.required' => 'You must enter a Category.',
        'category.unique' => $this->category . ' already exists. You must enter a unique Category.',
      ];
    }
}
