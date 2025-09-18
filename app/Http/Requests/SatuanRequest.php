<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SatuanRequest extends FormRequest
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
            'nama_satuan' =>  "required",
            'status' =>  "required",
            'stok_minimal' =>  "required",
            'remark' =>  "nullable",
        ];
    }
    public function messages(): array
    {
        return [
            'nama_satuan.required' => 'Harap isi terlebih dahulu',
            'stok_minimal.required' => 'Harap isi terlebih dahulu',
            'status.required' => 'Harap pilih terlebih dahulu',
        ];
    }
}
