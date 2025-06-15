<?php

namespace App\Http\Requests;

use App\Models\Kosnica;
use Illuminate\Foundation\Http\FormRequest;

class KosnicaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->isMethod('post')) {
            return $this->user()->can('create', Kosnica::class);
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $model = $this->route('kosnice');
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
            'oznaka' => 'required|string|max:100',
            'tip' => 'required|string|max:100',
            'status' => 'required|string|in:aktivna,neaktivna',
            'pcelinjak_id' => 'required|exists:pcelinjaks,id',
        ];
    }

    public function messages()
    {
        return [
            'oznaka.required' => 'Oznaka je obavezna.',
            'oznaka.string' => 'Oznaka mora biti tekst.',
            'oznaka.max' => 'Oznaka ne sme biti duža od 100 karaktera.',

            'tip.required' => 'Tip je obavezan.',
            'tip.string' => 'Tip mora biti tekst.',
            'tip.max' => 'Tip ne sme biti duži od 100 karaktera.',

            'status.required' => 'Status je obavezan.',
            'status.in' => 'Status mora biti "aktivna" ili "neaktivna".',

            'pcelinjak_id.required' => 'Pčelinjak je obavezan.',
            'pcelinjak_id.exists' => 'Izabrani pčelinjak ne postoji.',
        ];
    }
}
