<?php

namespace Modules\TypeUser\Entities;

use Illuminate\Database\Eloquent\Model;

class TypeUsers extends Model
{
    public $incrementing = false;

    protected $table        = 'type_users';
    protected $primaryKey   = 'id';
    public $fillable = [
        'id',
        'name',
        'flag'
    ];
}
