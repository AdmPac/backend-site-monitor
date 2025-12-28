<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле name обязательно для заполнения',
            'name.max' => 'Поле name должно быть не более 255 символов',
            'email.required' => 'Поле email обязательно для заполнения',
            'email.email' => 'Email написан некорректно',
            'email.unique' => 'Пользователь с таким email уже существует',
            'password.required' => 'Поле password обязательно для заполнения',
            'password.max' => 'Поле password должно быть не более 255 символов',
        ];
    }
}
