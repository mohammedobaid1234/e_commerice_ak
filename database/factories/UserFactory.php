<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
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
    public function definition(){
        // return [
        //     'name' => 'Mohammed Obaid',
        //     'email' => 'mhmd.obaid.18@gmail.com',
        //     'mobile_no' => '0594034429',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('12345678'), // password
        //     'remember_token' => Str::random(10),
        // ];
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile_no' => $this->faker->phoneNumber,
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10),
        ];
    }
}
