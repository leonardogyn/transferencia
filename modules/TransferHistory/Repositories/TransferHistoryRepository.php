<?php

namespace Modules\TransferHistory\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\TransferHistory\Entities\TransferHistory;
use Modules\TransferHistory\Repositories\Interfaces\TransferHistoryRepositoryInterface;

class TransferHistoryRepository extends BaseRepository implements TransferHistoryRepositoryInterface
{
    public function __construct(TransferHistory $transferHistory)
    {
        $this->model = $transferHistory;
    }
}
