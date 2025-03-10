<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama tidak boleh kosong.',
            'gender.required' => 'Jenis kelamin tidak boleh kosong.',
            'gender.in' => 'Pilih jenis kelamin yang valid.',
            'photo.image' => 'Foto harus berupa gambar.',
            'photo.mimes' => 'Foto hanya boleh berformat jpeg, png, jpg, gif, svg.',
            'photo.max' => 'Foto maksimal 2MB.',
            'phone.numeric' => 'Nomor telepon hanya boleh berisi angka.',
            'phone.digits_between' => 'Nomor telepon harus memiliki panjang antara 10 hingga 15 digit.',
        ];
    }
}
