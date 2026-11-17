<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeaveRequestFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'leave_type' => fake()->randomElement([
                'Annual Leave',
                'Sick Leave',
                'Family Responsibility Leave',
                'Unpaid Leave',
            ]),
            'start_date' => now()->addDays(2)->toDateString(),
            'end_date' => now()->addDays(5)->toDateString(),
            'reason' => fake()->sentence(),
            'status' => 'Pending',
        ];
    }
}
