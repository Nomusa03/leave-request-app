<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\LeaveRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaveRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_leave_requests(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('leave-requests.index'))
            ->assertOk();
    }

    public function test_user_can_create_a_leave_request(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('leave-requests.store'), [
                'leave_type' => 'Annual Leave',
                'start_date' => now()->addDays(2)->toDateString(),
                'end_date' => now()->addDays(5)->toDateString(),
                'reason' => 'Family holiday',
            ])
            ->assertRedirect(route('leave-requests.index'));

        $this->assertDatabaseHas('leave_requests', [
            'user_id' => $user->id,
            'leave_type' => 'Annual Leave',
            'status' => 'Pending',
        ]);
    }

    public function test_user_can_view_own_leave_request(): void
    {
        $user = User::factory()->create();

        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get(route('leave-requests.show', $leaveRequest))
            ->assertOk();
    }

    public function test_user_can_update_own_pending_leave_request(): void
    {
        $user = User::factory()->create();

        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $user->id,
            'status' => 'Pending',
        ]);

        $this->actingAs($user)
            ->put(route('leave-requests.update', $leaveRequest), [
                'leave_type' => 'Sick Leave',
                'start_date' => now()->addDays(3)->toDateString(),
                'end_date' => now()->addDays(4)->toDateString(),
                'reason' => 'Medical appointment',
            ])
            ->assertRedirect(route('leave-requests.index'));

        $this->assertDatabaseHas('leave_requests', [
            'id' => $leaveRequest->id,
            'leave_type' => 'Sick Leave',
            'reason' => 'Medical appointment',
        ]);
    }

    public function test_user_can_delete_own_pending_leave_request(): void
    {
        $user = User::factory()->create();

        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $user->id,
            'status' => 'Pending',
        ]);

        $this->actingAs($user)
            ->delete(route('leave-requests.destroy', $leaveRequest))
            ->assertRedirect(route('leave-requests.index'));

        $this->assertDatabaseMissing('leave_requests', [
            'id' => $leaveRequest->id,
        ]);
    }
}
