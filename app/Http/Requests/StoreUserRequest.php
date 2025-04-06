<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:20', 'unique:m_user,username'],
            'nama' => ['required', 'string', 'max:50'],
            'password' => ['required', Password::min(8)], // Password minimal 8 karakter
            'level_id' => ['required', 'integer', 'exists:m_level,level_id'], // Harus ada di tabel `m_level`
        ];
    }
}
