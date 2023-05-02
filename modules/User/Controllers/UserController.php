<?php

namespace Modules\User\Controllers;

use App\Http\Controllers\Controller;

use Modules\User\Request\UserRequest;
use Modules\User\Services\Interfaces\UserServiceInterface;
use Exception;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    public function list()
    {
        return $this->service->list();
    }

    public function create(UserRequest $request)
    {
        try {
            return $this->service->create($request->validated());
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar o cadastro'], 500);
        }
    }
}
