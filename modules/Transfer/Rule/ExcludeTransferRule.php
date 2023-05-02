<?php

namespace Modules\Transfer\Rule;

use Illuminate\Contracts\Validation\Rule;

class ExcludeTransferRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // check if the record is already in use.
        //$result = CertameCargo::where('cdCargo', $value)->count();
        //if ($result > 0) return false;

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Não é possível excluir este registro, o mesmo está em uso.';
    }
}
