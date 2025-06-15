<?php

namespace App\Http\Requests;

use App\Models\Drustvo;
use Illuminate\Foundation\Http\FormRequest;

class DrustvoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->isMethod('post')) {
            return $this->user()->can('create', Drustvo::class);
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $model = $this->route('drustva');
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
            'kosnica_id' => 'required|exists:kosnicas,id',
            'matica_starost' => 'required|integer|min:0',
            'jacina' => 'required|string|max:25|in:jako,slabo,srednje',
            'datum_formiranja' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'kosnica_id.required' => 'Košnica je obavezna.',
            'kosnica_id.exists' => 'Izabrana košnica ne postoji.',

            'matica_starost.required' => 'Starost matice je obavezna.',
            'matica_starost.integer' => 'Starost matice mora biti ceo broj.',
            'matica_starost.min' => 'Starost matice ne može biti negativna.',

            'jacina.required' => 'Jačina je obavezna.',
            'jacina.string' => 'Jačina mora biti tekst.',

            'datum_formiranja.required' => 'Datum formiranja je obavezan.',
            'datum_formiranja.date' => 'Datum formiranja mora biti validan datum.',
        ];
    }
}
