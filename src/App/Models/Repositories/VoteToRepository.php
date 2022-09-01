<?php

namespace Aryanhasanzadeh\Voteing\App\Models\Repositories;

use Aryanhasanzadeh\Voteing\App\Models\VoteTo;
use Illuminate\Database\Eloquent\Collection;

class VoteToRepository { 

    public function get(int $vote_title) : Collection
    {
        return VoteTo::title($vote_title)->get();
    }

    public function update(VoteTo $to,array $array) : VoteTo
    {
        $to->update([
            'status'=>$array['status'],
            'vote_title_id'=>$array['vote_title_id']
        ]);

        return $to;
    }


    public function delete(VoteTo $to)
    {
        $to->delete();
    }
    
}