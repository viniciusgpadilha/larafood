<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class Product extends Model
{
    use TenantTrait;
    
    protected $fillable = ['title', 'flag', 'price', 'description', 'image'];

    public function categories() {
        $this->belongsToMany(Category::class);
    }
}
