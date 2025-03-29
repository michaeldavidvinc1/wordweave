<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Like extends Pivot
{
    protected $table = "likes";

    public $incrementing = true;

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
