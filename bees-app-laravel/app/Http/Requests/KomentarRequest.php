<?php

namespace App\Http\Requests;

use App\Models\Komentar;
use Illuminate\Foundation\Http\FormRequest;

class KomentarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->isMethod('post')) {
            return $this->user()->can('create', Komentar::class);
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $model = $this->route('komentar');
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
            'sadrzaj' => 'required|string',
            'datum' => 'required|date',
            'aktivnost_id' => 'required|exists:aktivnosts,id',
        ];
    }

    public function messages()
    {
        return [
            'sadrzaj.required' => 'Sadržaj je obavezan.',
            'sadrzaj.string' => 'Sadržaj mora biti tekst.',

            'datum.required' => 'Datum je obavezan.',
            'datum.date' => 'Datum mora biti validan.',

            'aktivnost_id.required' => 'Aktivnost je obavezna.',
            'aktivnost_id.exists' => 'Izabrana aktivnost ne postoji.',

        ];
    }
}
