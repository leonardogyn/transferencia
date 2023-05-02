<?php

namespace Modules\TypeUser\Request;

use Modules\TypeUser\Rule\ExcludeTypeUsersRule;
use Illuminate\Foundation\Http\FormRequest;

class TypeUsersRequest extends FormRequest
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
            'id' => [
                'required',
                'unique:type_users,id,NULL,id',
                'max:36'
            ],
            'name' => [
                'required',
                'unique:type_users,name,NULL,name',
                'max:100',
            ],
            'flag' => [
                'required',
                'unique:type_users,flag,NULL,flag',
                'max:1',
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
                    'cnpj',
                    'unique:type_users,id,' . $this->id . ',id',
                    'string',
                    'max:36'
                ],
                'name' => [
                    'required',
                    'unique:type_users,name,' . $this->name . ',name',
                    'string',
                    'max:100',
                ],
                'flag' => [
                    'required',
                    'unique:type_users,flag,' . $this->flag . ',flag',
                    'string',
                    'max:100',
                ],
            ];

            return array_merge($rules_default, $rules_update);
        }
        // delete
        elseif ($this->route()->getActionMethod() == 'delete') {
            // Regras de exclusão
            $rules_destroy = [
                'id' => new ExcludeTypeUsersRule(),
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
            'id'            => 'Identificador',
            'name'          => 'Nome',
            'flag'          => 'Flag'
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
            'id.required'       => 'O campo Identificador é obrigatório',
            'name.required'     => 'O campo Nome é obrigatório',
            'flag.required'     => 'O campo Flag é obrigatório',
            'id.unique'         => 'O Identificador utilizado já está em uso',
            'name.unique'       => 'O Nome utilizado já está em uso',
            'flag.unique'       => 'A Flag utilizado já está em uso',
        ];
    }
}
