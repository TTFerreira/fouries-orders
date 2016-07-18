<?php

namespace App\Http\Requests\Items;

use App\Http\Requests\Request;

class StoreItemRequest extends Request
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
        'item_code' => 'required|unique:items,item_code',
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
        'description.required' => 'You must enter a description.'
      ];
    }
}