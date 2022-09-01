<?php

namespace Aryanhasanzadeh\Voteing\App\Models;

use Aryanhasanzadeh\Translator\App\Http\Traits\HasTranslat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteTitle extends Model
{
    use HasFactory;
    use HasTranslat;

    protected $fillable=[
        'name',
        'status',
    ];


    public function votes()
    {
        return $this->hasMany(Vote::class,'vote_title_id','id');
    }

    public function to()
    {
        return $this->hasMany(VoteTo::class,'vote_title_id','id');
    }
}
