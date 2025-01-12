<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\BookSessionRequest;
use App\Http\Requests\Member\CancelSessionRequest;
use App\Services\Member\BookingService;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;

        $this->middleware('permission:book-cancel-session')->only(['bookSession','cancelSession']);
        $this->middleware('permission:view-booking-history')->only('getBookingHistory');
        $this->middleware('permission:view-usage-report')->only('getUsageReport');
    }

    public function bookSession(BookSessionRequest $request)
    {
        $user = auth()->user();
        $result = $this->bookingService->bookSession($user, $request->session_id);

        if (isset($result['error'])) {
            return $this->errorResponse($result['error'], $result['status']);
        }

        return $this->successResponse($result['success'], $result['message']);
    }

    public function cancelSession(CancelSessionRequest $request)
    {
        $user = auth()->user();
        $result = $this->bookingService->cancelSession($user, $request->session_id);

        if (isset($result['error'])) {
            return $this->errorResponse($result['error'], $result['status']);
        }

        return $this->successResponse($result['success'], $result['message']);
    }

    public function getBookingHistory()
    {
        $user = auth()->user();
        $history = $this->bookingService->getBookingHistory($user);

        return $this->successResponse($history, 'Booking history retrieved successfully.');
    }

    public function getUsageReport()
    {
        $user = auth()->user();
        $report = $this->bookingService->getUsageReport($user);

        return $this->successResponse($report, 'Usage report retrieved successfully.');
    }
}
