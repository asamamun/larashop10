<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributeset extends Model
{
    use HasFactory;
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
	
	public function products()
    {
        return $this->hasMany(Product::class);
    }
}
