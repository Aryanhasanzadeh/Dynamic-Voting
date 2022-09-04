<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'status',
        'body',
        'is_private',
    ];

    public function to()
    {
        return $this->morphto();
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
