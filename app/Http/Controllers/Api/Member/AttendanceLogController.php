<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\StoreAttendanceRequest;
use App\Http\Requests\Member\CheckOutRequest;
use App\Services\Member\AttendanceService;
use Illuminate\Support\Facades\Log;

class AttendanceLogController extends Controller
{
    private $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;

        // Middleware for permission control
        $this->middleware('permission:store-attendance')->only(['store', 'checkout']);
    }

    /**
     * Store member attendance (Check-in).
     *
     * @param StoreAttendanceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAttendanceRequest $request)
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return $this->errorResponse('Unauthorized. User not authenticated.', 401);
            }

            $result = $this->attendanceService->recordAttendance($user->id, $request->training_session_id);

            Log::info('Attendance record result:', $result);

            if (isset($result['success']) && $result['success']) {
                return $this->successResponse($result['data'], $result['message']);
            }

            return $this->errorResponse($result['message'] ?? 'An unknown error occurred.', 400);
        } catch (\Exception $e) {
            Log::error('Error recording attendance: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return $this->errorResponse('An error occurred while recording attendance.', 500);
        }
    }



    /**
     * Handle checkout process.
     *
     * @param CheckOutRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(CheckOutRequest $request)
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return $this->errorResponse('Unauthorized. User not authenticated.', 401);
            }

            $result = $this->attendanceService->recordCheckout($user->id, $request->training_session_id);

            return $result['success']
                ? $this->successResponse($result['data'], $result['message'])
                : $this->errorResponse($result['message'], 400);
        } catch (\Exception $e) {
            Log::error('Error during checkout: ' . $e->getMessage());
            return $this->errorResponse('An error occurred during checkout.', 500);
        }
    }

    /**
     * Mark users as absent if they haven't checked in after the grace period.
     *
     * @param int $trainingSessionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAbsent($trainingSessionId)
    {
        try {
            $result = $this->attendanceService->markAbsentUsers($trainingSessionId);

            return $result['success']
                ? $this->successResponse($result['data'], $result['message'])
                : $this->errorResponse($result['message'], 400);
        } catch (\Exception $e) {
            Log::error('Error marking users as absent: ' . $e->getMessage());
            return $this->errorResponse('An error occurred while marking users as absent.', 500);
        }
    }
}
