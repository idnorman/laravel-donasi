<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MerchandiseTransaction>
 */
class MerchandiseTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentMethod = [
            'bank_transfer',
            'qris',
            'gopay',
            'ovo',
            'dana',
            'linkaja',
            'shopeepay',
            'paypal',
            'credit_card',
        ];
        return [
            'buyer_id' => \App\Models\User::role('donatur')->inRandomOrder()->first()->id,
            'merchandise_id' => \App\Models\Merchandise::inRandomOrder()->first()->id,
            'merchandise_price' => $this->faker->randomFloat(0, 10000, 100000),
            'address_province' => $this->faker->numberBetween(1, 34),
            'address_city' => $this->faker->numberBetween(1, 34),
            'address_detail' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'shipping_cost' => $this->faker->randomFloat(0, 10000, 100000),
            'merchandise_quantity' => $this->faker->numberBetween(1, 5),
            'payment_total' => $this->faker->randomFloat(0, 10000, 100000),
            'snap_token' => \Str::random(10),
            'payment_status' => 2,
            'payment_method' => $paymentMethod[$this->faker->numberBetween(0, 8)],
        ];
    }
}
