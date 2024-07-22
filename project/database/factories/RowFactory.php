<?php

namespace Database\Factories;

use App\Models\Row;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RowFactory extends Factory
{
    protected $model = Row::class;

    public function definition()
    {
        return [
            'id' => $this->faker->randomNumber(),
            'name' => $this->faker->word,
            'date' => Carbon::now()->format('Y-m-d')
        ];
    }
}
