<?php

namespace Aryanhasanzadeh\Voteing\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Aryanhasanzadeh\Voteing\App\Models\VoteTitle;

class VoteTitleFactory extends Factory
{

    protected $model= VoteTitle::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(20),
            'status' => rand(0,1),
        ];
    }

}
