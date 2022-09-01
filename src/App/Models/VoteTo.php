<?php

namespace Aryanhasanzadeh\Voteing\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteTo extends Model
{
    use HasFactory;


    protected $fillable=[
        'vote_title_id',
        'status',
    ];

    public function scopeTitle($query,$title_id)
    {
        return $query->where('title_id',$title_id);
    }

    public function to()
    {
        return $this->morphto();
    }

    public function title()
    {
        return $this->belongsTo(VoteTitle::class,'vote_title_id','id');
    }
}
