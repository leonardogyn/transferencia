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

    /**
     * @OA\Get(
     *     path="/api/account/list",
     *     tags={"Account"},
     *     summary="Listar as Contas",
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
     ** path="/api/account/create",
     *   tags={"Account"},
     *   summary="Criar Conta",
     *   @OA\Parameter(
     *      name="balance",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string",format="double")
     *   ),
     *   @OA\Parameter(
     *      name="user_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string",format="uuid")
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
