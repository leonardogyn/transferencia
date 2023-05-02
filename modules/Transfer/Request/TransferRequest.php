<?php

namespace Modules\Transfer\Request;

use Modules\Transfer\Rule\ExcludeTransferRule;
use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
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
        $value = $this->value;
        if (mb_strpos($value, ',') == false) {
            $value = floatval($this->value) * 100;
        }

        $this->merge([
            'value' => str_replace([',', '.'], '', $value) / 100,
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
                'unique:transfers,id,NULL,id',
                'max:36'
            ],
            'payer_id' => [
                'required',
                'max:36',
            ],
            'payee_id' => [
                'required',
                'max:36',
            ],
            'value' => [
                'required',
                'min:0',
                'gt:0',
                'max:9999999',
            ],
            'type_transfer_id' => [
                'required',
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
                    'unique:transfers,id,' . $this->id . ',id',
                    'max:36'
                ]
            ];

            return array_merge($rules_default, $rules_update);
        }
        // delete
        elseif ($this->route()->getActionMethod() == 'delete') {
            // Regras de exclusão
            $rules_destroy = [
                'id' => new ExcludeTransferRule(),
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
            'payer_id'          => 'Pagador',
            'paryee_id'         => 'Beneficiário',
            'value'             => 'Saldo',
            'type_transfer_id'  => 'Identificador de Transferência',
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
            'id.required'                   => 'O campo Identificador é obrigatório',
            'payer_id.required'             => 'O campo Identificador do Cliente é obrigatório',
            'payee_id.required'             => 'O campo Identificador do Cliente é obrigatório',
            'value.required'                => 'O campo Saldo é obrigatório',
            'value.gt'                      => 'O campo Valor deve ser maior que zero',
            'value.max'                     => 'O campo Valor é maior que o permitido',
            'type_transfer_id.required'     => 'O campo Identificador do Cliente é obrigatório',
        ];
    }
}
