<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 9), // Giả định có 50 người dùng
            'total' => $this->faker->randomFloat(2, 100, 1000), // Giá trị tổng từ 100 đến 1000
            'payment_method' => $this->faker->randomElement(['cash', 'vnpay', 'momo']),
            'recipient_name' => $this->faker->name(),
            'recipient_phone' => '0899384046',
            'recipient_address' => $this->faker->address(),
            'applied_discount_code' => $this->faker->optional()->word(),
            'status' => $this->faker->numberBetween(0, 5), // Trạng thái từ 0 đến 5
            'invoice_code' => $this->faker->unique()->bothify('HBZ-#####'),
            'note' => $this->faker->optional()->sentence(),
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'updated_at' => now(),
        ];
    }
}
