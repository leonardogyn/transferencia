<?php

namespace Modules\UserType\Controllers;

use App\Http\Controllers\Controller;
use Modules\UserType\Request\UserTypeRequest;
use Modules\UserType\Services\Interfaces\UserTypeServiceInterface;
use Exception;

/**
 * @OA\Info(title="Transfer", version="0.1")
 */
class UserTypeController extends Controller
{
    protected $service;

    public function __construct(UserTypeServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/user-type/list",
     *     tags={"UserType"},
     *     summary="Listar os Tipos de Usuários",
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     *     @OA\Response(response=500,description="Internal Server Error"),
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
     ** path="/api/user-type/create",
     *   tags={"UserType"},
     *   summary="Criar Tipo do Usuário",
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="flag",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string",maxLength=1)
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
    public function create(UserTypeRequest $request)
    {
        try {
            return $this->service->create($request->validated());
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar o cadastro'], 500);
        }
    }

    /**
     * @OA\Delete(
     ** path="/api/user-type/delete",
     *   tags={"UserType"},
     *   summary="Excluir Tipo do Usuário",
     *   @OA\Parameter(
     *      name="id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
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
    public function delete(UserTypeRequest $request)
    {
        try {
            if($this->service->delete($request->validated())) {
                return response()->json(['message' => 'Excluído com sucesso'], 200);
            }
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a exclusão'], 500);
        }
    }
}
