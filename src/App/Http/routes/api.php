<?php

use Aryanhasanzadeh\Voteing\App\Http\Controllers\VoteTitleController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => config('VoteManager.prefix'),
    'middleware' => config('VoteManager.middleware')
], function () {

    Route::group([
        'prefix' => config('VoteManager.vote_prefix'),
        'middleware' => config('VoteManager.vote_middleware'),
        'as'=>'voteManager.'
    ], function () {

        Route::resource('/title', VoteTitleController::class,[
        ])->only('index','show','store','update','destroy');
        
        Route::resource('/to', VoteTitleController::class,[
        ])->only('index','show','update','destroy');

    });

});    

