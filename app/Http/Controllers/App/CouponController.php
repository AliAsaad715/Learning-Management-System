<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\Coupon\CouponRequest;
use App\Responses\Response;
use App\Services\Coupon\CouponService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Throwable;

class CouponController extends Controller
{
    private CouponService $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function index($course_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->couponService->index($course_id);
            if($data['code'] == 404)
                return Response::error($data['message'], $data['code']);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            if($th instanceof AuthorizationException) {
                return Response::error($message, $th->getCode());
            }
            return Response::error($message);
        }
    }

    public function store(CouponRequest $request, $course_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->couponService->store($request->validated(), $course_id);
            if($data['code'] == 404)
                return Response::error($data['message'], $data['code']);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            if($th instanceof AuthorizationException) {
                return Response::error($message, $th->getCode());
            }
            return Response::error($message);
        }
    }

    // Update specific coupon.
    public function update(CouponRequest $request, $id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->couponService->update($request->validated(), $id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            if($th instanceof AuthorizationException) {
                return Response::error($message, $th->getCode());
            }
            return Response::error($message);
        }
    }

    // Show a specific coupon.
    public function show($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->couponService->show($id);
            if($data['code'] == 404)
                return Response::error($data['message'], $data['code']);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            if($th instanceof AuthorizationException) {
                return Response::error($message, $th->getCode());
            }
            return Response::error($message);
        }
    }

    // Delete a specific coupon by the course's owner.
    public function destroy($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->couponService->destroy($id);
            return Response::success([], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            if($th instanceof AuthorizationException) {
                return Response::error($message, $th->getCode());
            }
            return Response::error($message);
        }
    }

}
