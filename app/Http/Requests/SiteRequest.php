<?php

namespace App\Http\Requests;

use App\ValueObjects\DomainName;
use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $domain = new DomainName($this->full_url);
        $this->merge(['base_url' => $domain->getBaseUrl()]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:sites,title',
            'full_url' => 'required|string|max:255|url',
            'base_url' => 'required|string|max:255|unique:sites,base_url',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле title обязательно для заполнения',
            'title.string' => 'Поле title должно быть строкой',
            'title.max' => 'Поле title должно быть не более 255 символов',
            'title.unique' => 'Сайт с таким названием уже существует',
            'full_url.required' => 'Поле full_url обязательно для заполнения',
            'full_url.string' => 'Поле full_url должно быть строкой',
            'full_url.max' => 'Поле full_url должно быть не более 255 символов',
            'full_url.url' => 'Неверный формат url',
            'base_url.required' => 'Поле base_url обязательно для заполнения',
            'base_url.string' => 'Поле base_url должно быть строкой',
            'base_url.max' => 'Поле base_url должно быть не более 255 символов',
            'base_url.unique' => 'Такой base_url уже существует',
        ];
    }
}
