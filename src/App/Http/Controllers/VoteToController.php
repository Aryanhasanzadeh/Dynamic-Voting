<?php

namespace Aryanhasanzadeh\Voteing\App\Http\Controllers;

use Aryanhasanzadeh\Voteing\App\Http\Resources\VotetToResource;
use Aryanhasanzadeh\Voteing\App\Models\Repositories\VoteToRepository;
use Aryanhasanzadeh\Voteing\App\Models\VoteTo;
use Illuminate\Http\Request;

/**
 * @group Vote Manager
*/

class VoteToController extends ApiController
{
    private VoteToRepository $toRepo;

    public function __construct(VoteToRepository $toRepo)
    {
        $this->toRepo = $toRepo;
    }

     /**
     * get list of Vote by Vote Title Id
     * 
     * @bodyParam id int required the vote title id
     * 
     */
    public function index(Request $request)
    {
        $this->validate($request,[
            'vote_title_id' =>'required|int'
        ]);

        try {
            return $this->successResponse([
                'titles'=>VotetToResource::collection($this->toRepo->get($request->vote_title_id))
            ],'');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorResponse([],500,$th->getMessage());
        }
    }


    /**
     * get specified Vote 
     * 
     * @urlParam id required the id of the Vote 
    */
    public function show(VoteTo $voteTo)
    {
        try {
            return $this->successResponse([
                'title'=>VotetToResource::make($voteTo)
            ],'');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorResponse([],500,$th->getMessage());
        }
    }


    /**
     * Update the Specified  Vote 
     * 
     * @urlParam id required the id of the vote 
     * 
     * @bodyParam vote_title_id int required the id of vote title 
     * @bodyParam status int required the status 
    */
    public function update(Request $request, VoteTo $voteTo)
    {
        $this->validate($request,[
            'vote_title_id' =>'required|int',
            'status' =>'required|int|min:0|max:2',
        ]);
        try {
            return $this->successResponse([
                'title' => VotetToResource::make($this->toRepo->update($voteTo,$request->all()))
            ],'');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorResponse([],500,$th->getMessage());
        }
    }

    /**
     * Remove the specified Vote 
     * 
     * 
     * @urlParam id integer required The ID of the Vote 
     * 
    */
    public function destroy(VoteTo $voteTo)
    {
        try {

            $this->toRepo->delete($voteTo);
            
            return $this->successResponse([

            ],'');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorResponse([],500,$th->getMessage());
        }
    }
}
