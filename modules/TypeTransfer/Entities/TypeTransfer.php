<?php

namespace Modules\TypeTransfer\Entities;

use Illuminate\Database\Eloquent\Model;

class TypeTransfer extends Model
{
    public $incrementing = false;

    protected $table        = 'type_transfers';
    protected $primaryKey   = 'id';
    public $fillable = [
        'id',
        'name',
        'flag'
    ];
}
