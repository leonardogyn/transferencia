<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
* @OA\Tag(
*   name="UserType",
*   description="Listar os Tipos de Usuários"
* ),
* @OA\Tag(
*   name="User",
*   description="Listar os Usuários"
* ),
* @OA\Tag(
*   name="Account",
*   description="Listar as Contas"
* ),
* @OA\Tag(
*   name="Transfer",
*   description="Listar as Transferências"
* ),
* @OA\Tag(
*   name="TransferHistory",
*   description="Listar o Histórico das Transferências"
* ),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
