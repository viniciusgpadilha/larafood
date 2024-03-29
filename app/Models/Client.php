<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
class Client extends Authenticatable
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function evaluations()
    {
        return $this->belongsTo(Evaluation::class);
    }
}
