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

    /**
     * @OA\Get(
     *     path="/api/user/list",
     *     tags={"User"},
     *     summary="Listar os Usuários",
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
     ** path="/api/user/create",
     *   tags={"User"},
     *   summary="Criar Usuário",
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="cpf_cnpj",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string",format="email")
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="user_type_id",
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
