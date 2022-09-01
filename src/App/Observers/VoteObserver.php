<?php

namespace Aryanhasanzadeh\Voteing\App\Observers;

use Aryanhasanzadeh\Voteing\App\Jobs\UpdateVoteAvg;
use Aryanhasanzadeh\Voteing\App\Models\Vote;


class VoteObserver
{
    /**
     * Handle the Vote "created" event.
     *
     * @param  \Aryanhasanzadeh\Voteing\App\Models\Vote  $vote
     * @return void
     */
    public function created(Vote $vote)
    {
        dispatch((new UpdateVoteAvg($vote))->delay(2));
    }

    /**
     * Handle the Vote "updated" event.
     *
     * @param  \Aryanhasanzadeh\Voteing\App\Models\Vote  $vote
     * @return void
     */
    public function updated(Vote $vote)
    {
        //
    }

    /**
     * Handle the Vote "deleted" event.
     *
     * @param  \Aryanhasanzadeh\Voteing\App\Models\Vote  $vote
     * @return void
     */
    public function deleted(Vote $vote)
    {
        //
    }

    /**
     * Handle the Vote "restored" event.
     *
     * @param  \Aryanhasanzadeh\Voteing\App\Models\Vote  $vote
     * @return void
     */
    public function restored(Vote $vote)
    {
        //
    }

    /**
     * Handle the Vote "force deleted" event.
     *
     * @param  \Aryanhasanzadeh\Voteing\App\Models\Vote  $vote
     * @return void
     */
    public function forceDeleted(Vote $vote)
    {
        //
    }
}
