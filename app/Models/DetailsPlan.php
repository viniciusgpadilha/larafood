<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailsPlan extends Model
{
    protected $table = 'details_plan';

    protected $fillable = ['name'];

    public function plan() {
        $this->belongsTo(Plan::class);
    }
}
