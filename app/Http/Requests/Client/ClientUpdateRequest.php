<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
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
            'nama_lengkap' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $this->client->id,
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
            'jenis_client' => 'required|in:retainer,litigasi,non_litigasi',
        ];
    }
}
