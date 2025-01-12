<?php

namespace App\Services\Member;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\UserMembership;
use App\Models\TrainingSession;

class BookingService
{
    public function bookSession($user, $sessionId)
    {
        $session = TrainingSession::findOrFail($sessionId);

        if ($session->current_capacity >= $session->max_capacity) {
            return ['error' => 'Session is full. Please select another time.', 'status' => 400];
        }

        $userMembership = UserMembership::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$userMembership) {
            return ['error' => 'No active membership found.', 'status' => 400];
        }

        if ($userMembership->remaining_sessions <= 0) {
            return ['error' => 'You do not have enough remaining sessions.', 'status' => 400];
        }

        if ($session->allowed_membership_levels !== $userMembership->package->difficulty_level) {
            return ['error' => 'This session is not suitable for your membership level.', 'status' => 400];
        }

        $booking = Booking::create([
            'user_id' => $user->id,
            'session_id' => $session->id,
            'status' => 'booked',
            'booked_at' => now()->format('Y-m-d H:i:s'),

        ]);

        $session->increment('current_capacity');
        $userMembership->decrement('remaining_sessions');

        return ['success' => $booking, 'message' => 'Session booked successfully.'];
    }

    public function cancelSession($user, $sessionId)
    {
        $session = TrainingSession::findOrFail($sessionId);

        $booking = Booking::where('user_id', $user->id)
            ->where('session_id', $session->id)
            ->where('status', 'booked')
            ->first();

        if (!$booking) {
            return ['error' => 'You have no booking for this session.', 'status' => 400];
        }

        $currentTime = now();
        $sessionStartTime = Carbon::parse($session->start_time);

        if ($sessionStartTime->diffInDays($currentTime) < 1) {
            return ['error' => 'You can only cancel a session at least 1 day before.', 'status' => 400];
        }

        $session->decrement('current_capacity');
        $userMembership = UserMembership::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if ($userMembership) {
            $userMembership->increment('remaining_sessions');
        }

        $booking->update(['status' => 'cancelled']);

        return ['success' => null, 'message' => 'Session booking cancelled successfully.'];
    }

    public function getBookingHistory($user)
    {
        $bookings = Booking::where('user_id', $user->id)
            ->with('session')
            ->orderBy('booked_at', 'desc')
            ->get();

        return $bookings->map(function ($booking) {
            return [
                'session_name' => $booking->session->name,
                'start_time' => $booking->session->start_time,
                'status' => $booking->status,
                'booked_at' => $booking->booked_at ? Carbon::parse($booking->booked_at)->format('Y-m-d H:i:s') : null,
            ];
        });
    }

    public function getUsageReport($user)
    {
        $totalBooked = Booking::where('user_id', $user->id)->where('status', 'booked')->count();
        $totalCompleted = Booking::where('user_id', $user->id)->where('status', 'completed')->count();
        $totalCancelled = Booking::where('user_id', $user->id)->where('status', 'cancelled')->count();

        return [
            'total_booked' => $totalBooked,
            'total_completed' => $totalCompleted,
            'total_cancelled' => $totalCancelled,
        ];
    }
}
