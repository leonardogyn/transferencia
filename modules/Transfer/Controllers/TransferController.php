<?php

namespace Modules\Transfer\Controllers;

use App\Http\Controllers\Controller;

use Modules\Transfer\Request\TransferRequest;
use Modules\Transfer\Services\Interfaces\TransferServiceInterface;
use Exception;

class TransferController extends Controller
{
    protected $service;

    public function __construct(TransferServiceInterface $service)
    {
        $this->service = $service;
    }

    public function list()
    {
        return $this->service->list();
    }

    public function create(TransferRequest $request)
    {
        try {
            return $this->service->create($request->validated());
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar o cadastro'], 500);
        }
    }
}
