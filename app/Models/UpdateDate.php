<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdateDate extends Model
{
    protected $guarded = [];
    protected $casts = [
        'UpdateDateMake' => 'datetime',
        'UpdateDateAPI' => 'datetime',
    ];
}
