<?php

namespace App\Http\Requests;

use App\Models\Pcelinjak;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class PcelinjakRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->isMethod('post')) {
            return $this->user()->can('create', Pcelinjak::class);
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $model = $this->route('pcelinjaci');
            return $model && $this->user()->can('update', $model);
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'naziv' => 'required|string|max:255',
            'lokacija' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'naziv.required' => 'Naziv je obavezan.',
            'naziv.string' => 'Naziv mora biti tekst.',
            'naziv.max' => 'Naziv ne sme biti duži od 255 karaktera.',

            'lokacija.required' => 'Lokacija je obavezna.',
            'lokacija.string' => 'Lokacija mora biti tekst.',
            'lokacija.max' => 'Lokacija ne sme biti duža od 255 karaktera.',

        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('Nemate dozvolu za ovu akciju.');
    }
}
