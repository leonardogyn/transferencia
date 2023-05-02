<?php

namespace Modules\User\Request;

use Modules\User\Rule\ExcludeUserRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        // Remove caracteres especiais dos campos, deixando somente números.
        $this['cpf_cnpj'] = preg_replace('/[^0-9]/', '', $this['cpf_cnpj']);
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
                'unique:users,id,NULL,id',
                'max:36'
            ],
            'name' => [
                'required',
                'max:100',
            ],
            'cpf_cnpj' => [
                'required',
                'unique:users,cpf_cnpj,NULL,cpf_cnpj',
                'max:14',
            ],
            'email' => [
                'required',
                'unique:users,email,NULL,email',
                'max:100',
            ],
            'password' => [
                'required',
                'max:60',
            ],
            'type_user_id' => [
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
                    'unique:users,id,' . $this->id . ',id',
                    'max:36'
                ],
                'cpf_cnpj' => [
                    'required',
                    'unique:users,cpf_cnpj,' . $this->cpf_cnpj . ',cpf_cnpj',
                    'max:1',
                ],
                'email' => [
                    'required',
                    'unique:users,email,' . $this->email . ',email',
                    'max:1',
                ],
            ];

            return array_merge($rules_default, $rules_update);
        }
        // delete
        elseif ($this->route()->getActionMethod() == 'delete') {
            // Regras de exclusão
            $rules_destroy = [
                'id' => new ExcludeUserRule(),
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
            'name'              => 'Nome',
            'cpf_cnpj'          => 'CPF/CNPJ',
            'email'             => 'Email',
            'password'          => 'Senha',
            'type_user_id'      => 'Tipo do Usuário',
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
            'name.required'             => 'O campo Nome é obrigatório',
            'cpf_cnpj.required'         => 'O campo CPF/CNPJ é obrigatório',
            'email.required'            => 'O campo Email é obrigatório',
            'password.required'         => 'O campo Senha é obrigatório',
            'type_User_id.required'     => 'O campo Tipo do Usuário é obrigatório',
            'id.unique'                 => 'O Identificador utilizado já está em uso',
            'cpf_cnpj.unique'           => 'O CPF/CNPJ utilizado já está em uso',
            'email.unique'              => 'O Email utilizado já está em uso',
        ];
    }
}
