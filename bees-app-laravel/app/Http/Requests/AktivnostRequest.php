<?php

namespace App\Http\Requests;

use App\Models\Aktivnost;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class AktivnostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->isMethod('post')) {
            return $this->user()->can('create', Aktivnost::class);
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $model = $this->route('aktivnosti');
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
            'opis' => 'nullable|string',
            'tip' => 'required|string|max:100',
            'pocetak' => 'required|date',
            'kraj' => 'required|date|after_or_equal:pocetak',
            'status' => 'required',
            'drustvo_id' => 'required|exists:drustvos,id',
        ];
    }

    public function messages()
    {
        return [
            'naziv.required' => 'Naziv je obavezan.',
            'naziv.string' => 'Naziv mora biti tekst.',
            'naziv.max' => 'Naziv ne sme biti duži od 255 karaktera.',

            'opis.string' => 'Opis mora biti tekst.',

            'tip.required' => 'Tip je obavezan.',
            'tip.string' => 'Tip mora biti tekst.',
            'tip.max' => 'Tip ne sme biti duži od 100 karaktera.',

            'pocetak.required' => 'Datum početka je obavezan.',
            'pocetak.date' => 'Datum početka mora biti validan datum.',

            'kraj.required' => 'Datum završetka je obavezan.',
            'kraj.date' => 'Datum završetka mora biti validan datum.',
            'kraj.after_or_equal' => 'Datum završetka mora biti isti ili kasniji od početka.',

            'status.required' => 'Status je obavezan.',

            'drustvo_id.required' => 'Društvo je obavezno.',
            'drustvo_id.exists' => 'Izabrano društvo ne postoji.',

        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('Nemate dozvolu za ovu akciju.');
    }
}
