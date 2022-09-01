<?php

namespace Aryanhasanzadeh\Voteing\App\Http\Controllers;

use Aryanhasanzadeh\Voteing\App\Http\Resources\VoteTitleResource;
use Aryanhasanzadeh\Voteing\App\Models\Repositories\VoteTitleRepository;
use Aryanhasanzadeh\Voteing\App\Models\VoteTitle;
use Illuminate\Http\Request;

class VoteTitleController extends ApiController
{
    protected VoteTitleRepository $titleRepo;

    public function __construct(VoteTitleRepository $titleRepo)
    {
        $this->titleRepo=$titleRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
