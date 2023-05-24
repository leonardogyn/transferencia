<?php

namespace Modules\UserType\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory ;
use Modules\User\Entities\User;

class UserType extends Model
{
    public $incrementing = false;

    protected $table        = 'user_types';
    protected $primaryKey   = 'id';
    public $fillable = [
        'id',
        'name',
        'flag'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
