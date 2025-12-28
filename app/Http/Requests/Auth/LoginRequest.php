<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email|max:255',
            'password' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле email обязательно для заполнения',
            'email.email' => 'Email написан некорректно',
            'email.exists' => 'Пользователя с таким email не существует',
            'password.required' => 'Поле password обязательно для заполнения',
            'password.max' => 'Поле password должно быть не более 255 символов',
        ];
    }
}
