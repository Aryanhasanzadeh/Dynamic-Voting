<?php

namespace Aryanhasanzadeh\Voteing\App\Models\Repositories;

use Aryanhasanzadeh\Voteing\App\Models\Vote;
use Aryanhasanzadeh\Voteing\App\Models\VoteReport;
use DB;

class VoteReportRepository { 


    public function updateOrCreate(Vote $vote)
    {
        VoteReport::updateOrCreate(
            [
                'vote_title_id'=>$vote->vote_title_id,
                'to_type'=> $vote->to_type,
                'to_id'=> $vote->to_id,
            ],
            [
                'avg_rate'=>DB::raw("select avg(rate) from votes where vote_title_id ='".$vote->vote_title_id."' and to_type='".$vote->to_type."' and to_id='".$vote->to_id."'")
            ]
        );
    }
    
}