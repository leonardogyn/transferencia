<?php

namespace Modules\Transfer\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\Transfer\Entities\Transfer;
use Modules\Transfer\Repositories\Interfaces\TransferRepositoryInterface;

class TransferRepository extends BaseRepository implements TransferRepositoryInterface
{
    public function __construct(Transfer $transfer)
    {
        $this->model = $transfer;
    }
}
