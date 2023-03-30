<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SquadBuilderRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'match_id' => 'required|int'
        ];
    }

    public function messages()
    {
        return [
            'match_id.required' => 'Informe uma Match',
            'match_id.int' => 'Indentificação da Match Inválido'
        ];
    }
}
