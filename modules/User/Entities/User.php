<?php

namespace Modules\User\Entities;

use App\Http\Entities\TypeUser;
use Illuminate\Database\Eloquent\Model;

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
        'type_user_id'
    ];

    public function typeUser()
    {
        return $this->hasOne(TypeUser::class, 'id', 'type_user_id');
    }
}
