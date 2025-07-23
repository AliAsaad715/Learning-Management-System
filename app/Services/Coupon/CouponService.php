<?php

namespace App\Services\Coupon;

use App\Http\Resources\Coupon\CouponResource;
use App\Http\Resources\Coupon\CouponWithDetailsResource;
use App\Models\Coupon;
use App\Models\Course;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class CouponService
{
    public function index($course_id): array
    {
        $course = Course::query()->find($course_id);

        if(is_null($course)) {
            return ['message' => 'Course not found!', 'code' => 404];
        }

        Gate::authorize('owner', $course);
        $coupons = $course->coupons;

        return ['data' => CouponResource::collection($coupons), 'message' => 'Coupons retrieved successfully', 'code' => 200];
    }

    public function store($request, $course_id) : array
    {
        $course = Course::query()->find($course_id);

        if(is_null($course)) {
            return ['message' => 'Course not found!', 'code' => 404];
        }

        Gate::authorize('owner', $course);
        $coupon = Coupon::query()->create([
            'course_id' => $course_id,
            'code' => strtoupper($request['code']),
            'discount_type' => $request['discount_type'],
            'discount_value' => $request['discount_value'],
            'expires_at' => $request['expires_at'] ?? null,
            'max_uses' => $request['max_uses'] ?? null
        ]);

        return ['data' => new CouponWithDetailsResource($coupon), 'message' => 'Coupon created successfully', 'code' => 201];
    }

    public function update($request, $id) : array
    {
        $coupon = Coupon::query()->find($id);

        if(is_null($coupon)) {
            return ['message' => 'Coupon not found!', 'code' => 404];
        }

        if(auth('api')->id() != $coupon->course->teacher_id) {
            return ['message' => 'You are not the owner of this course', 'code' => 403];
        }

        $coupon->update($request->all());

        return ['data' => new CouponWithDetailsResource($coupon), 'message' => 'Coupon updated successfully', 'code' => 200];
    }

    public function show($id): array
    {
        $coupon = Coupon::query()->find($id);
        if(is_null($coupon)) {
            return ['message' => 'Coupon not found!', 'code' => 404];
        }

        Gate::authorize('owner', $coupon->course);

        return ['data' => new CouponWithDetailsResource($coupon), 'message' => 'Coupon retrieved successfully', 'code' => 200];
    }

    public function destroy($id) : array
    {
        $coupon = Coupon::query()->find($id);
        if(is_null($coupon)) {
            return ['message' => 'Coupon not found!', 'code' => 404];
        }

        if(auth('api')->id() != $coupon->course->teacher_id) {
            return ['message' => 'You are not the owner of this course', 'code' => 403];
        }

        $coupon->delete();
        return ['message' => 'Coupon deleted successfully', 'code' => 200];
    }
}
