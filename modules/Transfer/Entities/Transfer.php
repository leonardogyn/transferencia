<?php

namespace Modules\Transfer\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Account\Entities\Account;

class Transfer extends Model
{
    public $incrementing = false;

    protected $table        = 'transfers';
    protected $primaryKey   = 'id';
    public $fillable = [
        'id',
        'account_payer_id',
        'account_payee_id',
        'value'
    ];

    public function payer()
    {
        return $this->hasOne(Account::class, 'id', 'account_payer_id');
    }

    public function payee()
    {
        return $this->hasOne(Account::class, 'id', 'account_payee_id');
    }
}
