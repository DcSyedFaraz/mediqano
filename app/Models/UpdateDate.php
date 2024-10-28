<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdateDate extends Model
{
    protected $casts = [
        'UpdateDateMake' => 'datetime',
        'UpdateDateAPI' => 'datetime',
    ];
}
