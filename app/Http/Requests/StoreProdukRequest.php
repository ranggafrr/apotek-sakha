<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdukRequest extends FormRequest
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
            'nama_barang' =>  "required",
            'satuan' =>  "required",
            'stok' =>  "required",
            'harga_jual' =>  "required",
            'harga_beli' =>  "required",
        ];
    }
    public function messages(): array
    {
        return [
            'nama_barang.required' => 'Harap isi terlebih dahulu',
            'satuan.required' => 'Harap pilih terlebih dahulu',
            'stok.required' => 'Harap isi terlebih dahulu',
            'harga_jual.required' => 'Harap isi terlebih dahulu',
            'harga_beli.required' => 'Harap isi terlebih dahulu',
        ];
    }
}
