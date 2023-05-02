<?php

namespace Modules\TypeUser\Controllers;

use App\Http\Controllers\Controller;
use Modules\TypeUser\Request\TypeUsersRequest;
use Modules\TypeUser\Services\Interfaces\TypeUsersServiceInterface;
use Exception;

class TypeUsersController extends Controller
{
    protected $service;

    public function __construct(TypeUsersServiceInterface $service)
    {
        $this->service = $service;
    }

    public function list()
    {
        return $this->service->list();
    }

    public function create(TypeUsersRequest $request)
    {
        try {
            return $this->service->create($request->validated());
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar o cadastro'], 500);
        }
    }
}
