<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$wkwXMb7IkuPJmNtC.e9wguw8nbDbXJeTcKxWrY8a.d.uUSycEwb4W', // password
            'remember_token' => Str::random(10),
            'is_admin' => 'false'
        ];
    }

    public function newUser(){
        return $this->state([
                  'name' => 'New Name',
                  'email' => 'newname@email.com',
                  'is_admin' => 'true'
        ]);
      }
}
