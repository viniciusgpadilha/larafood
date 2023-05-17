<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailsPlan extends Model
{
    protected $table = 'details_plan';

    public function plan() {
        $this->belongsTo(Plan::class);
    }
}
