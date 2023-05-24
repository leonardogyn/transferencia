<?php

namespace Modules\User\Entities;

use Modules\UserType\Entities\UserType;
use Illuminate\Database\Eloquent\Model;
use Modules\Account\Entities\Account;

class User extends Model
{
    public $incrementing = false;

    protected $table        = 'users';
    protected $primaryKey   = 'id';
    public $fillable = [
        'id',
        'name',
        'cpf_cnpj',
        'email',
        'password',
        'user_type_id'
    ];

    public function UserType()
    {
        return $this->hasOne(UserType::class, 'id', 'user_type_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
