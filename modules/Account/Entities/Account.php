<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Client\Entities\User;

class Account extends Model
{
    public $incrementing = false;

    protected $table        = 'Accounts';
    protected $primaryKey   = 'id';
    public $fillable = [
        'id',
        'balance',
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
