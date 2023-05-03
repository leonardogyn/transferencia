<?php

namespace Modules\TransferHistory\Controllers;

use App\Http\Controllers\Controller;
use Modules\TransferHistory\Services\Interfaces\TransferHistoryServiceInterface;
use Modules\TransferHistory\Request\TransferHistoryRequest;
use Exception;

class TransferHistoryController extends Controller
{
    protected $service;

    public function __construct(TransferHistoryServiceInterface $service)
    {
        $this->service = $service;
    }

    public function list()
    {
        return $this->service->list();
    }

    public function create(TransferHistoryRequest $request)
    {
        try {
            return $this->service->create($request->validated());
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar o cadastro'], 500);
        }
    }
}
