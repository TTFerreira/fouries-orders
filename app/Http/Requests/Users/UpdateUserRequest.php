<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request
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
      $user = $this->route()->parameter('user');

      return [
        'name' => 'required|unique:users,name,'.$user->id,
        'email' => 'email|required|unique:users,email,'.$user->id,
        'company_id' => 'required'
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
        'name.required' => 'You must enter the User\'s Name.',
        'name.unique' => $this->name . ' already exists. You must enter a unique User Name.',
        'email.email' => 'Please enter a valid email address.',
        'email.required' => 'You must enter the User\'s Email Address.',
        'email.unique' => $this->email . ' already exists. You must enter a unique email address.',
        'company_id.required' => 'You must select the User\'s Company.'
      ];
    }
}
