<?php

namespace App\Http\Controllers\App;

use App\Responses\Response;
use App\Services\Comment\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class CommentController
{
    private CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($episode_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->commentService->index($episode_id);
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
            $data = $this->commentService->store($request, $episode_id);
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
            $data = $this->commentService->show($episode_id);
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
            $data = $this->commentService->update($request, $id);
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
            $data = $this->commentService->destroy($id);
            return Response::success($data['user'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }
}
