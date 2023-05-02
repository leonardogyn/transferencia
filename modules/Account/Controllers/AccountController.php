<?php

namespace Modules\Account\Controllers;

use App\Http\Controllers\Controller;

use Modules\Account\Request\AccountRequest;
use Modules\Account\Services\Interfaces\AccountServiceInterface;
use Exception;

class AccountController extends Controller
{
    protected $service;

    public function __construct(AccountServiceInterface $service)
    {
        $this->service = $service;
    }

    public function list()
    {
        return $this->service->list();
    }

    public function create(AccountRequest $request)
    {
        try {
            return $this->service->create($request->validated());
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar o cadastro'], 500);
        }
    }
}
