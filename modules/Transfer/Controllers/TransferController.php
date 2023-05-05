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

    /**
     * @OA\Get(
     *     path="/api/transfer/list",
     *     tags={"Transfer"},
     *     summary="Listar as Transferências",
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Not Found"),
     *     @OA\Response(response=500,description="Validate Error"),
     *     @OA\MediaType(mediaType="application/json")
     * )
     */
    public function list()
    {
        return $this->service->list();
    }

    /**
     * @OA\Post(
     ** path="/api/transfer/create",
     *   tags={"Transfer"},
     *   summary="Criar Transferência",
     *   @OA\Parameter(
     *      name="account_payer_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string",format="uuid")
     *   ),
     *   @OA\Parameter(
     *      name="account_payee_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string",format="uuid")
     *   ),
     *   @OA\Parameter(
     *      name="value",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="number",format="double")
     *   ),
     *   @OA\Response(response=201,description="Created"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=400,description="Bad Request"),
     *   @OA\Response(response=404,description="Not found"),
     *   @OA\Response(response=403,description="Forbidden"),
     *   @OA\Response(response=422,description="Validate Error"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\MediaType(mediaType="application/json")
     *)
     **/
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
