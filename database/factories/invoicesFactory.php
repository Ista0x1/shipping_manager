<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class invoicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name(),
            'description'=>$this->faker->text(),
            'due_date'=>$this->faker->date(),
            'invoice_date'=>$this->faker->date(),
            'tax_amount'=>444,
            'tax_rate'=>444,
            'status_value'=>444,
            'status'=>'مدفوعة',
            'invoice_total'=>444,
            'discount'=>33,
            'priceperitem'=>333,
            'quantity'=>33,
        ];
    }
}
