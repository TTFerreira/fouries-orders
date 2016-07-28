<?php

namespace App\Http\Requests\Items;

use App\Http\Requests\Request;

class UpdateItemRequest extends Request
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
      $item = $this->route()->parameter('item');

      return [
        'item_code' => 'required|unique:items,item_code,'.$item->id,
        'item_category_id' => 'required',
        'description' => 'required',
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
        'item_code.required' => 'You must enter a Code.',
        'item_code.unique' => $this->item_code . ' already exists. You must enter a unique Code.',
        'item_category_id.required' => 'You must select a Category.',
        'description.required' => 'You must enter a description.'
      ];
    }
}
