<?php

namespace Aryanhasanzadeh\Voteing\App\Http\Traits;

use Aryanhasanzadeh\Voteing\App\Models\Vote;
use Aryanhasanzadeh\Voteing\App\Models\VoteTo;

trait HasVoteing {

    public function votes()
    {
        return $this->morphMany(Vote::class,'to');
    }
    
    public function voteTos()
    {
        return $this->morphMany(VoteTo::class,'to');
    }

    public function voteReport()
    {
        return $this->morphMany(VoteTo::class,'to');
    }

}