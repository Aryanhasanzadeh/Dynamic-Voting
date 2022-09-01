<?php

namespace Aryanhasanzadeh\Voteing\App\Http\Controllers;

use Aryanhasanzadeh\Voteing\App\Http\Resources\VotetToResource;
use Aryanhasanzadeh\Voteing\App\Models\Repositories\VoteToRepository;
use Aryanhasanzadeh\Voteing\App\Models\VoteTo;
use Illuminate\Http\Request;

class VoteToController extends ApiController
{
    private VoteToRepository $toRepo;

    public function __construct(VoteToRepository $toRepo)
    {
        $this->toRepo = $toRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
