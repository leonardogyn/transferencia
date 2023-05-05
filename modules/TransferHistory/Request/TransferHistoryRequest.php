<?php

namespace Modules\TransferHistory\Request;

use Modules\TransferHistory\Rule\ExcludeTransferHistoryRule;
use Illuminate\Foundation\Http\FormRequest;

class TransferHistoryRequest extends FormRequest
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
            'transfer_id' => [
                'required',
                'unique:transfers_histories,transfer_id,NULL,transfer_id',
                'max:36',
            ],
            'user_id' => [
                'required',
                'max:36',
            ],
            'account_id' => [
                'required',
                'max:36',
            ],
            'flag_transfer' => [
                'required',
                'max:1',
            ],
            'value_transfer' => [
                'required',
                'min:0',
                'gte:0',
                'max:9999999',
            ],
            'value_old' => [
                'required',
                'min:0',
                'gte:0',
                'max:9999999',
            ],
            'value_new' => [
                'required',
                'min:0',
                'gte:0',
                'max:9999999',
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
                    'unique:transfers_histories,id,' . $this->id . ',id',
                    'string',
                    'max:36'
                ],
                'transfer_id' => [
                    'required',
                    'unique:transfers_histories,transfer_id,' . $this->transfer_id . ',transfer_id',
                    'string',
                    'max:36',
                ],
            ];

            return array_merge($rules_default, $rules_update);
        }
        // delete
        elseif ($this->route()->getActionMethod() == 'delete') {
            // Regras de exclusão
            $rules_destroy = [
                'id' => new ExcludeTransferHistoryRule(),
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
            'transfer_id'       => 'Identificador da Transferência',
            'user_id'           => 'Identificador do Usuário',
            'account_id'        => 'Identificador da Conta',
            'flag_transfer'     => 'Tipo da Transferência',
            'value_transfer'    => 'Valor Transferido',
            'value_old'         => 'Saldo anterior da Conta',
            'valeu_new'         => 'Saldo novo na Conta',
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
            'transfer_id.required'      => 'O campo Identificador da Transferência é obrigatório',
            'user_id.required'          => 'O campo Identificador do Usuário é obrigatório',
            'account_id.required'       => 'O campo Identificador da Conta é Obrigatório',
            'flag_transfer.required'    => 'O campo Tipo da Transferência é Obrigatório',
            'value_transfer.required'   => 'O campo Valor Transferido é Obrigatório',
            'value_old.required'        => 'O campo Saldo anterior da Conta é Obrigatório',
            'valeu_new.required'        => 'O campo Saldo novo na Conta é Obrigatório',
            'id.unique'                 => 'O Identificador utilizado já está em uso',
            'transfer_id.unique'        => 'O Identificador da Transferência já está em uso',
        ];
    }
}
