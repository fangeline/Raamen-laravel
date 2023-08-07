<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ramen extends Model
{
    use HasFactory;
    protected $table = 'ramens';
    protected $fillable = [
        'id', 
        'meat_id', 
        'name', 
        'broth', 
        'price'
    ];

    public function meat()
    {
        return $this->belongsTo(Meat::class, 'meat_id', 'id');
    }
}
