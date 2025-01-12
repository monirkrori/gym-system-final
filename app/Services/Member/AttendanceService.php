<?php

namespace App\Services\Member;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AttendanceLog;
use App\Models\TrainingSession;
use Illuminate\Support\Facades\Log;

class AttendanceService
{
    /**
     * Grace period in minutes for attendance
     */
    private const ATTENDANCE_GRACE_PERIOD = 30;

    /**
     * Record user attendance for a training session
     *
     * @param int $userId User ID
     * @param int $trainingSessionId Training session ID
     * @return array
     */
    public function recordAttendance(int $userId, int $trainingSessionId): array
    {
        // Validate inputs
        if (!is_numeric($userId) || !is_numeric($trainingSessionId)) {
            return ['success' => false, 'message' => 'Invalid input data.'];
        }

        try {
            $trainingSession = $this->validateTrainingSession($trainingSessionId);

            if (!$trainingSession) {
                return ['success' => false, 'message' => 'Training session is not available for attendance.'];
            }

            if ($this->hasExistingAttendance($userId, $trainingSessionId)) {
                return ['success' => false, 'message' => 'Attendance already recorded for this session.'];
            }

            $attendanceStatus = $this->calculateAttendanceStatus($trainingSession->start_time);

            $attendanceLog = AttendanceLog::create([
                'user_id' => $userId,
                'training_session_id' => $trainingSessionId,
                'check_in' => now(),
                'status' => $attendanceStatus['status'],
                'notes' => $attendanceStatus['notes'],
            ]);

            return [
                'success' => true,
                'message' => 'Attendance recorded successfully.',
                'data' => $attendanceLog
            ];
        } catch (\Exception $e) {
            Log::error('Error recording attendance', [
                'exception' => $e->getMessage(),
                'user_id' => $userId,
                'training_session_id' => $trainingSessionId,
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'An error occurred while recording attendance.'
            ];
        }
    }


    /**
     * Record checkout for a user's attendance
     *
     * @param int $userId User ID
     * @param int $trainingSessionId Training session ID
     * @return array
     */
    public function recordCheckout($userId, $trainingSessionId): array
    {
        $attendance = AttendanceLog::where([
            'user_id' => $userId,
            'training_session_id' => $trainingSessionId,
        ])->whereNull('check_out')->first();

        if (!$attendance) {
            return ['success' => false, 'message' => 'No active check-in found.'];
        }

        $attendance->update([
            'check_out' => now(),
            'notes' => $this->appendCheckoutNote($attendance->notes)
        ]);

        return ['success' => true, 'data' => $attendance];
    }

    /**
     * Mark absent users for a training session
     *
     * @param int $trainingSessionId Training session ID
     * @return array
     */
    public function markAbsentUsers($trainingSessionId): array
    {
        $absentUsers = $this->getAbsentUsers($trainingSessionId);

        foreach ($absentUsers as $user) {
            AttendanceLog::create([
                'user_id' => $user->id,
                'training_session_id' => $trainingSessionId,
                'status' => 'absent',
                'notes' => 'Automatically marked as absent after grace period'
            ]);
        }

        return ['success' => true, 'message' => 'Absent users marked successfully.'];
    }

    /**
     * Validate if training session is available for attendance
     *
     * @param int $sessionId Training session ID
     * @return TrainingSession|null
     */
    private function validateTrainingSession($sessionId)
    {
        return TrainingSession::where('id', $sessionId)
            ->where('status', 'scheduled')
            ->where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->first();
    }

    /**
     * Check if user already has attendance record for session
     *
     * @param int $userId User ID
     * @param int $sessionId Training session ID
     * @return bool
     */
    private function hasExistingAttendance($userId, $sessionId)
    {
        return AttendanceLog::where('user_id', $userId)
            ->where('training_session_id', $sessionId)
            ->exists();
    }

    /**
     * Calculate attendance status based on session start time
     *
     * @param string $sessionStartTime Session start time
     * @return array
     */
    private function calculateAttendanceStatus($sessionStartTime)
    {
        $currentTime = now();
        $startTime = Carbon::parse($sessionStartTime);
        $minutesDifference = $currentTime->diffInMinutes($startTime, false);

        $isLate = $minutesDifference > self::ATTENDANCE_GRACE_PERIOD;

        return [
            'status' => $isLate ? 'late' : 'present',
            'notes' => $this->generateAttendanceNote($isLate, $minutesDifference)
        ];
    }

    /**
     * Generate attendance note based on timing
     *
     * @param bool $isLate
     * @param int $minutesDifference
     * @return string
     */
    private function generateAttendanceNote($isLate, $minutesDifference)
    {
        if ($isLate) {
            return sprintf('Checked in late: %d minutes after session start', $minutesDifference);
        }

        if ($minutesDifference < 0) {
            return sprintf('Early check-in: %d minutes before session start', abs($minutesDifference));
        }

        return 'On time attendance';
    }

    /**
     * Append checkout note to existing notes
     *
     * @param string $existingNotes
     * @return string
     */
    private function appendCheckoutNote($existingNotes)
    {
        return $existingNotes . "\nChecked out at: " . now()->format('Y-m-d H:i:s');
    }

    /**
     * Get users who haven't recorded attendance
     *
     * @param int $trainingSessionId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getAbsentUsers($trainingSessionId)
    {
        return User::whereNotIn('id', function($query) use ($trainingSessionId) {
            $query->select('user_id')
                ->from('attendance_logs')
                ->where('training_session_id', $trainingSessionId);
        })->get();
    }
}
