<?php

namespace Database\Factories;

use App\Models\Directory;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company . '.' . $this->faker->fileExtension(),
            'file_size' => $this->faker->randomFloat(2, 1024, 2048),
            'path' => $this->faker->filePath()
        ];
    }
}
