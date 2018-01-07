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
        $method = $this->method();
        $rule = [];

        switch($method){
            case "POST":
                $rule = [
                    'name' => 'required',
                    'email' => 'required',
                    'role_id' => 'required',
                    'status' => 'required',
                    'password' => 'required',
                ];
                break;
            case 'PUT':
            case 'PATCH':
                $rule = [
                    'name' => 'required',
                    'email' => 'required',
                    'role_id' => 'required',
                    'status' => 'required',
                ];
            break;
        }

        return $rule;
    }
}
