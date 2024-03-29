<?php

namespace Database\Factories;

use App\Models\Setup_Details;
use App\Models\SetupDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class Setup_DetailsFactory  extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setup_Details::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bank_name' => $this->faker->company,
            'country' => $this->faker->country,
        ];
    }
}
