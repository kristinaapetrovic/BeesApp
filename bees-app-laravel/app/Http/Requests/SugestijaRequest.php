<?php

namespace App\Http\Requests;

use App\Models\Sugestija;
use Illuminate\Foundation\Http\FormRequest;

class SugestijaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->isMethod('post')) {
            return $this->user()->can('create', Sugestija::class);
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $model = $this->route('sugestije');
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
            'poruka' => 'required|string',
            'datum_kreiranja' => 'required|date',
            'aktivnost_id' => 'required|exists:aktivnosts,id',
        ];
    }

    public function messages()
    {
        return [
            'poruka.required' => 'Poruka je obavezna.',
            'poruka.string' => 'Poruka mora biti tekst.',

            'datum_kreiranja.required' => 'Datum kreiranja je obavezan.',
            'datum_kreiranja.date' => 'Datum kreiranja mora biti validan datum.',

            'aktivnost_id.required' => 'Aktivnost je obavezna.',
            'aktivnost_id.exists' => 'Izabrana aktivnost ne postoji.',
        ];
    }
}
