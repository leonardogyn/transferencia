<?php

namespace Modules\UserType\Controllers;

use App\Http\Controllers\Controller;
use Modules\UserType\Request\UserTypeRequest;
use Modules\UserType\Services\Interfaces\UserTypeServiceInterface;
use Exception;

class UserTypeController extends Controller
{
    protected $service;

    public function __construct(UserTypeServiceInterface $service)
    {
        $this->service = $service;
    }

    public function list()
    {
        return $this->service->list();
    }

    public function create(UserTypeRequest $request)
    {
        try {
            return $this->service->create($request->validated());
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar o cadastro'], 500);
        }
    }
}
