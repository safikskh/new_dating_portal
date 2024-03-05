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
            
        'username' => 'required',
        'firstName' => 'required',       
        'lastName' => 'required',       
        'email' => 'required',       
        'password' => 'required',       
        'dob' => 'required',       
        'iAmSeekingA' => 'required',
        'sexualOrientation' => 'required',
        'sex' => 'required',     
        'zipCode' => 'required',      
        'civilStatus' => 'required',       
        'height' => 'required',       
        'weight' => 'required',       
        'hairColor' => 'required',       
        'eyeColor' => 'required',       
        'searching' => 'required',       
        'bodyType' => 'required',       
        'tattoos' => 'required',       
        'piercing' => 'required',       
        'children' => 'required',       
        'smoking' => 'required',       
        'matchWords' => 'required',       
        'membership_id' => 'required',
      
        ];
    }
}
