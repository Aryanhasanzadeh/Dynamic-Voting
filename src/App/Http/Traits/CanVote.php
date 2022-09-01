<?php

namespace Aryanhasanzadeh\Voteing\App\Http\Traits;

trait CanVote {

    public function votes()
    {
        return $this->hasMany(Vote::class,'user_id','id');
    }
    
}