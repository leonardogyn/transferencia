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

    /**
     * @OA\Get(
     *     path="/api/transfer-history/list",
     *     tags={"TransferHistory"},
     *     summary="Listar o Histórico das Transferências",
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Not Found"),
     *     @OA\Response(response=500,description="Validate Error"),
     *     @OA\MediaType(mediaType="application/json")
     * )
     */
    public function list()
    {
        try {
            return $this->service->list();
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem'], 500);
        }
    }

    /**
     * @OA\Post(
     ** path="/api/transfer-history/create",
     *   tags={"TransferHistory"},
     *   summary="Criar Histórico de Transferências",
     *   @OA\Parameter(
     *      name="transfer_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string",format="uuid")
     *   ),
     *   @OA\Parameter(
     *      name="user_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string",format="uuid")
     *   ),
     *   @OA\Parameter(
     *      name="account_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string",format="uuid")
     *   ),
     *   @OA\Parameter(
     *      name="flag_transfer",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string",maxLength=1)
     *   ),
     *   @OA\Parameter(
     *      name="value_transfer",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="number",format="double")
     *   ),
     *   @OA\Parameter(
     *      name="value_old",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="number",format="double")
     *   ),
     *   @OA\Parameter(
     *      name="value_new",
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
