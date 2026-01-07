<?php

namespace App\Http\Requests\Progres;

use Illuminate\Foundation\Http\FormRequest;

class ProgresStoreRequest extends FormRequest
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
            'judul_progres' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'tanggal_progres' => 'required|date|date_format:Y-m-d',
            'urutan' => 'required|integer|min:1',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'file_invoice' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ];
    }
}
