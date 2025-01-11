<?php

namespace App\Http\Controllers\Api\Member;

use App\Models\MealPlan;
use App\Http\Controllers\Controller;
use App\Http\Requests\Member\SubscribeMealPlanRequest;
use App\Models\UserMembership;
use App\Services\Member\SubscribeService;

class MealPlanController extends Controller
{
    protected $subscribeService;


    /**
     * Construct a new MealPlanController instance.
     */
    public function __construct(SubscribeService $subscribeService)
    {
        $this->middleware('permission:subscriptions')->only(['subscribe', 'show']);
        $this->subscribeService = $subscribeService;


    }

    /**
     * Subscribe a user to a meal plan.
     *
     * @param SubscribeMealPlanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribeMealPlan(SubscribeMealPlanRequest $request)
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return $this->errorResponse('Unauthorized access.', 401);
            }

            $this->subscribeService->subscribeToMealPlan($user->id, $request->meal_plan_id);

            return $this->successResponse(null, 'Successfully subscribed to the meal plan.');
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred: ' . $e->getMessage(), 500);
        }
    }


    /**
     * Show details of a meal plan.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Find the meal plan by ID
        $mealPlan = MealPlan::find($id);

        if (!$mealPlan) {
            return $this->errorResponse('Meal plan not found.', 404);
        }

        return $this->successResponse($mealPlan, 'Meal plan retrieved successfully.');
    }
}
