<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\Comment\CommentRequest;
use App\Http\Requests\Comment\ShowMoreRequest;
use App\Http\Requests\LoadMore\LoadMoreRequest;
use App\Responses\Response;
use App\Services\Comment\CommentService;
use Illuminate\Http\JsonResponse;
use Throwable;

class CommentController extends Controller
{
    private CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    // Get all comments for specific episode, with a maximum of 15 comments per page.
    public function index($episode_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->commentService->index($episode_id);
            if($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::successForPaginate($data['data'], $data['meta'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    // Load more comments, they are not appearing on the last page.
    public function loadMore($episode_id, LoadMoreRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->commentService->loadMore($episode_id, $request->validated());
            if($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::successForPaginate($data['data'], $data['meta'],$data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    // Get the authenticated user's comments for a specific episode.
    public function getMyComments($episode_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->commentService->getMyComments($episode_id);
            if($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    // Add comment for specific episode.
    public function store(CommentRequest $request, $episode_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->commentService->store($request, $episode_id);
            if($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    // Update specific comment.
    public function update(CommentRequest $request, $id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->commentService->update($request->validated(), $id);
            if($data['code'] == 404 || $data['code'] == 401) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    // Delete specific comment.
    public function destroy($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->commentService->destroy($id);
            if($data['code'] == 404 || $data['code'] == 401) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success([], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    // Add Like to specific comment.
    public function addLikeToComment($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->commentService->addLikeToComment($id);
            if($data['code'] == 404 || $data['code'] == 401) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    // Remove Like from specific comment.
    public function removeLikeFromComment($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->commentService->removeLikeFromComment($id);
            if($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }
}
