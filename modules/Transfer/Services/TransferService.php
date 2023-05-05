<?php

namespace Modules\Transfer\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Account\Services\Interfaces\AccountServiceInterface;
use Modules\Transfer\Repositories\Interfaces\TransferRepositoryInterface;
use Modules\Transfer\Services\Interfaces\TransferServiceInterface;
use Modules\TransferHistory\Services\Interfaces\TransferHistoryServiceInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Ramsey\Uuid\Uuid;

class TransferService implements TransferServiceInterface
{

    protected $transferRepository;
    protected $accountService;
    protected $transferHistoryService;

    public function __construct(
        TransferRepositoryInterface $transferRepository,
        AccountServiceInterface $accountServiceInterface,
        TransferHistoryServiceInterface $transferHistoryServiceInterface
    ) {
        $this->transferRepository = $transferRepository;
        $this->accountService = $accountServiceInterface;
        $this->transferHistoryService = $transferHistoryServiceInterface;
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
        try {
            DB::beginTransaction();

            $accountPayer = $this->accountService->find($transfer['account_payer_id'], ['with' => 'user.userType']);

            // shopkeeper don't send money
            if(Config::get('constants.userDeniedTransfer.shopkeeper') == $accountPayer->user->userType->flag) {
                return response()->json(['error' => ['message' => ['account_payer_id' => 'Usuário não permitido para efetuar esta transfência']]], 422);
            }

            // Payer and Payee must be different
            //if($accountPayee == $accountPayer) {
            //    return response()->json(['error' => ['message' => ['account_payer_id' => 'O Pagador e beneficiário devem ser diferente']]], 422);
            //}

            // Check - Have account Balance
            if(!$this->checkHaveAccountBalance($accountPayer,$transfer)) {
                return response()->json(['error' => ['message' => ['account_payer_id' => 'Usuário não possui saldo na conta para esta transferência']]], 422);
            }

            // Check - Credit Authorizer
            if(!$this->creditAuthorizer()) {
                return response()->json(['error' => ['message' => ['transfer' => 'A transferência não foi autorizada']]], 403);
            }

            $createdTransfer = $this->transferRepository->create($transfer);

            // Perform debit transaction
            if(!$arrayDebit = $this->performTransaction($createdTransfer->id,$createdTransfer->value,$accountPayer,Config::get('constants.transferTypes.debit'))) {
                return response()->json(['error' => ['message' => ['transfer_history_debit' => 'Falha ao efetuar o histórico de Débito da transação']]], 500);
            }

            $accountPayee = $this->accountService->find($transfer['account_payee_id'], ['with' => 'user.userType']);

            // Perform credit transaction
            if(!$arrayCredit = $this->performTransaction($createdTransfer->id,$createdTransfer->value,$accountPayee,Config::get('constants.transferTypes.credit'))) {
                return response()->json(['error' => ['message' => ['transfer_history_credit' => 'Falha ao efetuar o histórico de Crédito da transação']]], 500);
            }

            DB::commit();

            // Trasaction Credit - push notification
            $this->pushNotification($arrayCredit);

            return $createdTransfer;
        } catch (Exception $ex) {
            report($ex);
            DB::rollBack();
            return response()->json(['error' => ['message' => ['transfer' => 'Falha ao efetuar a transferência']]], 500);
        }
    }

    private function checkHaveAccountBalance($accountPayer,$transfer) {
        return $accountPayer['balance'] >= $transfer['value'] ? true : false;
    }

    private function creditAuthorizer() {
        try {
            $response = Http::get(Config::get('constants.urlCreditAuthorizer'));
            return $response->successful();
        } catch (RequestException $ex) {
            report($ex);
            return false;
        }
    }

    private function performTransaction($transferId, $transferValue, $account,$flagTransfer) {
        try {
            $accountBalance = $account->balance;
            if($flagTransfer===Config::get('constants.transferTypes.credit')) {
                $accountBalanceNew = $accountBalance + $transferValue;
            } else {
                $accountBalanceNew = $accountBalance - $transferValue;
            }
            $account->balance = $accountBalanceNew;

            $accountUserId = $account->user->id;
            $newAccount = $this->accountService->update($account);

            $transferHistory = [
                'id' => Uuid::uuid4()->toString(),
                'transfer_id' => $transferId,
                'user_id' => $accountUserId,
                'account_id' => $newAccount->id,
                'flag_transfer' => $flagTransfer,
                'value_transfer' => $transferValue,
                'value_old' => $accountBalance,
                'value_new' => $accountBalanceNew
            ];
            return $this->transferHistoryService->create($transferHistory);
        } catch (\Exception $ex) {
            report($ex);
            return false;
        }
    }

    private function pushNotification($arrayCredit) {
        try {
            $response = Http::get(Config::get('constants.urlNotify'),json_decode($arrayCredit,true));
            return $response->successful();
        } catch (RequestException $ex) {
            report($ex);
            return false;
        }
    }

    public function update($entity)
    {
        return $this->transferRepository->update($entity);
    }
}
