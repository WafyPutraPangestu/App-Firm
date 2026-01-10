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
        'judul_progres'   => 'required|string|max:255',
        'keterangan'      => 'nullable|string', // Keterangan biasanya boleh kosong
        'tanggal_progres' => 'required|date',
        'urutan'          => 'required|integer|min:1',
        
        // Validasi untuk Multiple Files (Array)
        'file_path'       => 'nullable|array',
        'file_path.*'     => 'file|mimes:pdf,doc,docx,jpg,png|max:10240', // Validasi per file
        
        'file_invoice'    => 'nullable|array',
        'file_invoice.*'  => 'file|mimes:pdf,doc,docx,jpg,png|max:10240',
        ];
    }
}
