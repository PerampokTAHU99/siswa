<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SiswaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Siswa::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'alamat' => $this->faker->address,
            'kelas' => $this->faker->randomElement(['10', '11', '12']),
            'jurusan' => $this->faker->randomElement(['RPL', 'TKJ', 'AKL', 'OTKP', 'BDP']), // Example majors
            'prestasi' => $this->faker->sentence(), // Random sentence to simulate achievements
        ];
    }
}
