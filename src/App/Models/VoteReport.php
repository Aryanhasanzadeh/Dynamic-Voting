<?php

namespace Aryanhasanzadeh\Voteing\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteReport extends Model
{
    use HasFactory;


    protected $fillable=[
        'avg_rate',
        'vote_title_id',
    ];

    public function to()
    {
        return $this->morphto();
    }

    public function title()
    {
        return $this->belongsTo(VoteTitle::class,'vote_title_id','id');
    }
}
