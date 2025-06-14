<?php

namespace App\Http\Controllers\App;

use App\Responses\Response;
use App\Services\Reply\ReplyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ReplyController extends Controller
{
    private ReplyService $replyService;

    public function __construct(ReplyService $replyService)
    {
        $this->replyService = $replyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($episode_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->replyService->index($episode_id);
            return Response::success($data['user'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $episode_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->replyService->store($request, $episode_id);
            return Response::success($data['user'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($episode_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->replyService->show($episode_id);
            return Response::success($data['user'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->replyService->update($request, $id);
            return Response::success($data['user'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->replyService->destroy($id);
            return Response::success($data['user'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }
}
