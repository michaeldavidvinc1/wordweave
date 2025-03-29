<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Favorite extends Pivot
{
    protected $table = 'favorites';

    public $incrementing = true;

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
