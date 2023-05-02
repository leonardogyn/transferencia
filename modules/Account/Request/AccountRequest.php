<?php

namespace Modules\Account\Request;

use Modules\Account\Rule\ExcludeAccountRule;
use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $balance = $this->balance;
        if (mb_strpos($balance, ',') == false) {
            $balance = floatval($this->balance) * 100;
        }

        $this->merge([
            'balance' => str_replace([',', '.'], '', $balance) / 100,
        ]);
    }

    /**
     * Rules
     */
    public function rules()
    {
        // Inicializa variável.
        $rules_default = array();
        $rules_update = array();
        $rules_destroy = array();

        // Regras de criação e edição
        $rules_default = [
            'id' => [
                'required',
                'unique:accounts,id,NULL,id',
                'max:36'
            ],
            'balance' => [
                'required',
                'min:0',
                'gt:0',
                'max:9999999',
            ],
            'user_id' => [
                'required',
                'unique:accounts,user_id,NULL,user_id',
                'max:36',
            ],
        ];

        // create
        if ($this->route()->getActionMethod() == 'create') {
            return $rules_default;
        }
        // update
        elseif ($this->route()->getActionMethod() == 'update') {
            $rules_update = [
                'id' => [
                    'required',
                    'unique:accounts,id,' . $this->id . ',id',
                    'max:36'
                ],
                'user_id' => [
                    'required',
                    'unique:accounts,user_id,' . $this->user_id . ',user_id',
                    'max:36',
                ],
            ];

            return array_merge($rules_default, $rules_update);
        }
        // delete
        elseif ($this->route()->getActionMethod() == 'delete') {
            // Regras de exclusão
            $rules_destroy = [
                'id' => new ExcludeAccountRule(),
            ];

            return $rules_destroy;
        }

        // merg.
        return array_merge($rules_default, $rules_update, $rules_destroy);
    }
    // Fim do método rules.

    /**
     * Validate
     */
    public function validated(): array
    {
        $attributes = parent::validated();
        return $attributes;
    }

    /**
     * Return the friendly field name.
     *
     * @return array
     */
    public function attributes()
    {
        $result = [
            'id'                => 'Identificador',
            'balance'           => 'Saldo',
            'user_id'           => 'Identificador do Usuário',
        ];

        return $result;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.required'               => 'O campo Identificador é obrigatório',
            'balance.required'          => 'O campo Saldo é obrigatório',
            'balance.gt'                => 'O campo Saldo deve ser maior que zero',
            'balance.max'               => 'O campo Saldo é maior que o permitido',
            'user_id.required'          => 'O campo Identificador do Usuário é obrigatório',
            'id.unique'                 => 'O Identificador utilizado já está em uso',
            'client_id.unique'          => 'O Usuário já possui uma conta',
        ];
    }
}
