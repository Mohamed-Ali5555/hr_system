<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\section;

class EmployeerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'=>$this->faker->word,
            'slug'=>$this->faker->unique()->slug,
            'address'=>$this->faker->text,
            'note'=>$this->faker->text,
            'email' => $this->faker->unique()->safeEmail(),
            
            'nationality'=>$this->faker->word,
            
            'photo'=>$this->faker->imageUrl('350','350'),
            // 'section_id'=>$this->faker->randomElement(section::pluck('id')),
            // $sections = section::pluck('id');
             'section_id'=>section::factory(),

            // 'section_id'=>section::pluck('id')->random([]),
            
            'salary'=>$this->faker->numberBetween(100,1000),
            'national_id'=>$this->faker->numberBetween(0,1000),
            'status'=>$this->faker->randomElement(['pending','accept']),
            'phone'=>$this->faker->phoneNumber,
            'address'=>$this->faker->address,
            'start_time'=>$this->faker->time('H:i:s'),
            'end_time'=>$this->faker->time('H:i:s'),
            'date_of_contact'=>$this->faker->date("Y-m-d"),
            'date'=>$this->faker->date("Y-m-d"),
            'type'=>$this->faker->randomElement(['mail','femail']),
        ];
    }
}
