<?php

namespace App\Http\Requests\Perkara;

use Illuminate\Foundation\Http\FormRequest;

class PerkaraStoreRequest extends FormRequest
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
            // Validasi Perkara
            'jenis_perkara' => 'required|string|max:255',
            'deskripsi_perkara' => 'required|string',
            'tanggal_mulai' => 'nullable|date|date_format:Y-m-d', // Jika ingin manual input, tapi di view tidak ada inputnya (otomatis di service)
            
            // Validasi Surat Kuasa (Baru)
            'nomor_surat' => 'nullable|string|max:255',
            'tanggal_surat' => 'required|date|date_format:Y-m-d',
            'file_surat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // Max 2MB
        ];
    }
}
