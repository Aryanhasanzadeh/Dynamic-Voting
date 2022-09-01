<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_reports', function (Blueprint $table) {
            $table->id();
            $table->float('avg_rate',3,2)->default(0);
            $table->unsignedBigInteger('vote_title_id')->index();
            $table->morphs('to');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('vote_title_id')->references('id')->on('vote_titles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_reports');
    }
};
