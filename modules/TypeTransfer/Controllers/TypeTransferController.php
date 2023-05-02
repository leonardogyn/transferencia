<?php

namespace Modules\TypeTransfer\Controllers;

use App\Http\Controllers\Controller;
use Modules\TypeTransfer\Services\Interfaces\TypeTransferServiceInterface;
use Modules\TypeTransfer\Request\TypeTransferRequest;
use Exception;

class TypeTransferController extends Controller
{
    protected $service;

    public function __construct(TypeTransferServiceInterface $service)
    {
        $this->service = $service;
    }

    public function list()
    {
        return $this->service->list();
    }

    public function create(TypeTransferRequest $request)
    {
        try {
            return $this->service->create($request->validated());
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar o cadastro'], 500);
        }
    }
}
