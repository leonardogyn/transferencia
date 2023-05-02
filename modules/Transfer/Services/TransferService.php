<?php

namespace Modules\Transfer\Services;

use Illuminate\Support\Facades\DB;
use Modules\Account\Services\Interfaces\AccountServiceInterface;
use Modules\Transfer\Repositories\Interfaces\TransferRepositoryInterface;
use Modules\Transfer\Services\Interfaces\TransferServiceInterface;
use Illuminate\Support\Facades\Config;

class TransferService implements TransferServiceInterface
{

    protected $transferRepository;
    //protected $historyTransferRepository;
    //protected $typeTransferService;
    //protected $typeUsersService;
    protected $accountService;

    public function __construct(
        TransferRepositoryInterface $transferRepository,
        AccountServiceInterface $accountServiceInterface
    ) {
        $this->transferRepository = $transferRepository;
        $this->accountService = $accountServiceInterface;
    }

    public function list()
    {
        return $this->transferRepository->all();
    }

    public function find($id, $param = null)
    {
        return $this->transferRepository->find($id, $param);
    }

    public function create(array $transfer)
    {
        $retorno = null;
        try {
            DB::beginTransaction();

            $accountPayer = $this->accountService->find($transfer['account_payer_id'], ['with' => 'user.typeUser']);

            // Shopkeeper
            if(Config::get('constants.userDeniedTransfer.shopkeeper') == $accountPayer->user->typeUser->flag) {
                return response()->json(['message' => 'Usuário não permitido para efetuar esta transfência'], 403);
            }

            $retorno = $this->transferRepository->create($transfer);
            DB::commit();

        } catch (\Exception $ex) {
            report($ex);
            DB::rollBack();
            return response()->json(['message' => 'Falha ao efetuar a transferência'], 500);
        }
        return $retorno;
    }

    public function update($model, $id)
    {
    }
    public function delete($model)
    {
    }
}
