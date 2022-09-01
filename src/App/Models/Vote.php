<?php

namespace Aryanhasanzadeh\Voteing\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;


    protected $fillable=[
        'vote_title_id',
        'user_id',
        'rate',
    ];

    public function to()
    {
        return $this->morphto();
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function title()
    {
        return $this->belongsTo(VoteTitle::class,'vote_title_id','id');
    }
}
