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
            'jenis_perkara' => 'required|string|max:255',
            'deskripsi_perkara' => 'required|string',
            'tanggal_mulai' => 'nullable|date | date_format:Y-m-d',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai | after:tanggal_mulai | date_format:Y-m-d',
        ];
    }
}
