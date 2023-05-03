<?php

namespace Modules\TransferHistory\Entities;

use Illuminate\Database\Eloquent\Model;

class TransferHistory extends Model
{
    public $incrementing = false;

    protected $table        = 'transfers_histories';
    protected $primaryKey   = 'id';
    public $fillable = [
        'id',
        'transfer_id',
        'user_id',
        'account_id',
        'flag_transfer',
        'value_transfer',
        'value_old',
        'value_new'
    ];

    public function transfer()
    {
        return $this->hasOne(Transfer::class, 'id', 'transfer_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function account()
    {
        return $this->hasOne(Account::class, 'id', 'account_id');
    }
}
