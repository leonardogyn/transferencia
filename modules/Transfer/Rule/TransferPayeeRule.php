<?php

namespace Modules\Transfer\Rule;

use Illuminate\Contracts\Validation\Rule;
use Modules\Account\Services\Interfaces\AccountServiceInterface;

class TransferPayeeRule implements Rule
{
    protected $service;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(AccountServiceInterface $service)
    {
        $this->service = $service;
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
        // Exists
        try {
            return $this->service->find($value, null);
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A Conta do Beneficiário não existe';
    }
}
