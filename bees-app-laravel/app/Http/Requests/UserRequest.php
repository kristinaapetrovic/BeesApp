<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $model=$this->route('user');
        return $this->user()->can('update', $model);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user,
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ime je obavezno.',
            'name.string' => 'Ime mora biti tekst.',
            'name.max' => 'Ime ne sme biti duže od 255 karaktera.',

            'email.required' => 'Email je obavezan.',
            'email.email' => 'Email mora biti validan.',
            'email.unique' => 'Email je već zauzet.',

            'password.required' => 'Lozinka je obavezna.',
            'password.min' => 'Lozinka mora imati najmanje 6 karaktera.',
            'password.confirmed' => 'Lozinke se ne poklapaju.',
        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('Nemate dozvolu za ovu akciju.');
    }
}
