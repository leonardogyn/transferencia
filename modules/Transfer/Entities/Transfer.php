<?php

namespace Modules\Transfer\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Account\Entities\Account;

class Transfer extends Model
{
    public $incrementing = false;

    protected $table        = 'Transfers';
    protected $primaryKey   = 'id';
    public $fillable = [
        'id',
        'payer_id',
        'payee_id',
        'value',
        'type_transfer_id'
    ];

    public function payer()
    {
        return $this->hasOne(Account::class, 'id', 'payer_id');
    }

    public function payee()
    {
        return $this->hasOne(Account::class, 'id', 'payee_id');
    }

    public function typeTransfer()
    {
        return $this->hasOne(TypeTransfer::class, 'id', 'type_transfer_id');
    }
}
