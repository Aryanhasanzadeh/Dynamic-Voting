<?php

namespace Aryanhasanzadeh\Voteing\App\Http\Controllers;

use Aryanhasanzadeh\Voteing\App\Http\Resources\VoteTitleResource;
use Aryanhasanzadeh\Voteing\App\Models\Repositories\VoteTitleRepository;
use Aryanhasanzadeh\Voteing\App\Models\VoteTitle;
use Illuminate\Http\Request;

/**
 * @group VoteTitle Manager
*/

class VoteTitleController extends ApiController
{
    protected VoteTitleRepository $titleRepo;

    public function __construct(VoteTitleRepository $titleRepo)
    {
        $this->titleRepo=$titleRepo;
    }

    /**
     * get list of vote titles
    */
    public function index(Request $request)
    {
        try {
            return $this->successResponse([
                'titles'=>VoteTitleResource::collection($this->titleRepo->get($request))
            ],'');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorResponse([],500,$th->getMessage());
        }
    }

    /**
     * store a new Vote Title
     * 
     * @bodyParam name string required the name 
     * @bodyParam status id required the status 
    */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'status'=>'sometimes|int|max:2|min:0'
        ]);

        try {
            return $this->successResponse([
                'title'=>VoteTitleResource::make($this->titleRepo->setTranslator()->create($request->all(),config('VoteManager.auto_translate')))
            ],'');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorResponse([],500,$th->getMessage());
        }
        
    }

    /**
     * get specified Vote Title
     * 
     * @urlParam id required the id of the Vote Title
    */
    public function show(VoteTitle $title)
    {
        try {
            return $this->successResponse([
                'title'=>VoteTitleResource::make($title)
            ],'');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorResponse([],500,$th->getMessage());
        }
    }


    /**
     * Update the Specified  Vote Title
     * 
     * @urlParam id required the id of the vote title
     * 
     * @bodyParam name string required the name 
     * @bodyParam status id required the status 
    */
    public function update(Request $request,VoteTitle $title)
    {
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'status'=>'sometimes|int|max:2|min:0'
        ]);

        try {
            return $this->successResponse([
                'title'=>VoteTitleResource::make($this->titleRepo->setTranslator()->update($title,$request->all(),config('VoteManager.auto_translate')))
            ],'');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorResponse([],500,$th->getMessage());
        }
    }

    /**
     * Remove the specified Vote Title
     * 
     * 
     * @urlParam id integer required The ID of the Vote Title
     * 
    */
    public function destroy(VoteTitle $title)
    {
        try {
            $this->titleRepo->delete($title);

            return $this->successResponse([],'');

        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorResponse([],500,$th->getMessage());
        }
    }
}
