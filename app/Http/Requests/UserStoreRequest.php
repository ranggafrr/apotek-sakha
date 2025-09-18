<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'nama_lengkap' =>  "required",
            'username' =>  "required",
            'password' =>  "required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/",
            'role' =>  "required",
        ];
    }
    public function messages(): array
    {
        return [
            'nama_lengkap.required' => 'Harap isi terlebih dahulu',
            'username.required' => 'Harap isi terlebih dahulu',
            'password.required' => 'Harap isi terlebih dahulu',
            'password.min' => 'Password minimal 6 karakter',
            'password.regex' => 'Password harus mengandung huruf & angka',
            'role.required' => 'Harap pilih terlebih dahulu',
        ];
    }
}
