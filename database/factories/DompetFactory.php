<?php

namespace Database\Factories;

use App\Models\Dompet;
use Illuminate\Database\Eloquent\Factories\Factory;

class DompetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dompet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'saldo' => 0,
            'created_at' => now()
        ];
    }
}
