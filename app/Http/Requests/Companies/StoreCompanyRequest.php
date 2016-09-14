<?php

namespace App\Http\Requests\Companies;

use App\Http\Requests\Request;

class StoreCompanyRequest extends Request
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
        'name' => 'required|unique:companies,name',
        'telephone' => 'required',
        'street_number' => 'required',
        'street_name' => 'required',
        'city' => 'required',
        'postal_code' => 'required',
        'country' => 'required'
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
        'name.required' => 'You must enter the Company Name.',
        'name.unique' => $this->name . ' already exists. You must enter a unique Company Name',
        'telephone.required' => 'You must enter the telephone number.',
        'street_number.required' => 'You must enter the street number.',
        'street_name.required' => 'You must enter the street name.',
        'city.required' => 'You must enter the city.',
        'postal_code.required' => 'You must enter the postal code.',
        'country.required' => 'You must enter the country.'
      ];
    }
}
