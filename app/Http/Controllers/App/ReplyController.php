<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\Reply\ReplyRequest;
use App\Responses\Response;
use App\Services\Reply\ReplyService;
use Illuminate\Http\JsonResponse;
use Throwable;

class ReplyController extends Controller
{
    private ReplyService $replyService;

    public function __construct(ReplyService $replyService)
    {
        $this->replyService = $replyService;
    }

    // Get all replies for specific comment.
    public function index($comment_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->replyService->index($comment_id);
            if($data['code'] == 404) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($message);
        }
    }

    // Add reply for specific comment.
    public function store(ReplyRequest $request, $comment_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->replyService->store($request->validated(), $comment_id);
            if($data['code'] == 404) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($message);
        }
    }

    // Update specific reply.
    public function update(ReplyRequest $request, $id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->replyService->update($request->validated(), $id);
            if($data['code'] == 404 || $data['code'] == 401) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($message);
        }
    }

    // Delete a specific reply by the course teacher.
    public function destroyForTeacher($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->replyService->destroyForTeacher($id);
            if($data['code'] == 404 || $data['code'] == 401) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success([], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($message);
        }
    }

    // Delete a specific reply by the reply's owner.
    public function destroyForStudent($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->replyService->destroyForStudent($id);
            if($data['code'] == 404 || $data['code'] == 401) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success([], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($message);
        }
    }

    // Add Like to specific reply.
    public function addLikeToReply($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->replyService->addLikeToReply($id);
            if($data['code'] == 404 || $data['code'] == 401) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($message);
        }
    }

    // Remove Like from specific reply.
    public function removeLikeFromReply($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->replyService->removeLikeFromReply($id);
            if($data['code'] == 404) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($message);
        }
    }
}
