<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $table = 'details';
    protected $fillable = [
        'header_id',
        'ramen_id',
        'quantity'
    ];

    public function header()
    {
        return $this->belongsTo(Header::class, 'header_id', 'id');
    }

    public function ramen()
    {
        return $this->belongsTo(Ramen::class, 'ramen_id', 'id');
    }
}
