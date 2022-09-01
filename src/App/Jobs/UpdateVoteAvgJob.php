<?php

namespace Aryanhasanzadeh\Voteing\App\Jobs;

use Aryanhasanzadeh\Voteing\App\Models\Repositories\VoteReportRepository;
use Aryanhasanzadeh\Voteing\App\Models\Vote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateVoteAvgJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Vote $vote;
    protected VoteReportRepository $voteRepo;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Vote $vote)
    {
        $this->vote=$vote;
        $this->voteRepo=new VoteReportRepository();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->voteRepo->updateOrCreate($this->vote);
    }
}
