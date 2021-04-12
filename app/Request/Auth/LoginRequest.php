<?php

declare(strict_types=1);

namespace App\Request\Auth;

use Hyperf\Validation\Request\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'username'=>"required|max:12",
            'password'=>"required|max:12",
            'code'=>"required|max:4",
            'codekey'=>"required",
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'username不能为空',
            'password.required'  => 'password不能为空',
            'username.max'=>'username最大值不能超过12',
            'password.max'=>'password最大值不能超过12',
            'code.required'=>'code不能为空',
            'code.max'=>'code长度不能超过4',
            'codekey.required'=>'codekey不能为空',
        ];
    }
}
