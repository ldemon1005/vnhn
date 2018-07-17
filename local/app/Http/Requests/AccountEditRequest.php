<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountEditRequest extends FormRequest
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
            'username' => 'unique:accounts,username,'.$this->segment(4).',id'
        ];
    }
    public function messages()
    {
        return [
            'username.unique'=>'Tài khoản đã tồn tại'
        ];
    }
}
