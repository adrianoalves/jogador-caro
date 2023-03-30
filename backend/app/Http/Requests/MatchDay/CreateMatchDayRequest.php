<?php

namespace App\Http\Requests\MatchDay;

use App\Rules\OnlyDateInFutureForMatchDay;
use Illuminate\Foundation\Http\FormRequest;

class CreateMatchDayRequest extends FormRequest
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
            'when'  => [ 'required', new OnlyDateInFutureForMatchDay ],
            'where' => [ 'required', 'min:5' ],
            'observations' => [ 'sometimes' ],
        ];
    }

    public function messages()
    {
        return [
            'when.required' => 'A Data do evento com pelo menos 2 horas de antecedência é Obrigatória',
            'where.required' => 'O endereço com o local do evento é Obrigatório',
            'observations' => 'Por favor, insira uma observação'
        ];
    }
}
