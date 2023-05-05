<?php

namespace Modules\UserType\Entities;

use Illuminate\Database\Eloquent\Model;

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
}
