<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenjulanRequest extends FormRequest
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
            'kode_transaksi' =>  "required",
            'kode_barang' =>  "required",
            'qty' =>  "required",
        ];
    }
    public function messages(): array
    {
        return [
            'kode_barang.required' => 'Harap isi terlebih dahulu',
            'qty.required' => 'Harap isi terlebih dahulu',
        ];
    }
}
