<?php

namespace Modules\User\Rule;

use Illuminate\Contracts\Validation\Rule;
use Modules\UserType\Services\Interfaces\UserTypeServiceInterface;

class UserRule implements Rule
{
    protected $service;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(UserTypeServiceInterface $service)
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
            return $this->service->find($value);
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
        return 'O Tipo de Usuário não existe';
    }
}
