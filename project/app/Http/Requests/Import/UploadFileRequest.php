<?php

namespace App\Http\Requests\Import;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file' => 'required|mimes:xlsx'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Файл обязателен для загрузки.',
            'file.mimes'    => 'Файл должен быть формата XLSX.',
        ];
    }
}
