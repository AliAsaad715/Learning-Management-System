<?php

namespace App\Services\Comment;

use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Models\Episode;

class CommentService
{
    // Get all comments for specific episode, with a maximum of 15 comments per page.
    public function index($episode_id): array
    {
        $episode = Episode::query()->find($episode_id);
        if(is_null($episode)) {
            return ['message' => 'Episode not found!', 'code' => 404];
        }
        $comments = $episode->comments()->latest('comment_date')->paginate(15);
        return [
            'data' => CommentResource::collection($comments),
            'meta' => [
                'current_page' => $comments->currentPage(),
                'has_more_pages' => $comments->hasMorePages(),
                'next_page' => $comments->hasMorePages() ? $comments->currentPage() + 1 : null,
            ],
            'message' => 'Comments retrieved successfully',
            'code' => 200
        ];
    }

    // Load more comments, they are not appearing on the last page.
    public function loadMore($episode_id, $request): array
    {
        $episode = Episode::query()->find($episode_id);
        if(is_null($episode)) {
            return ['message' => 'Episode not found!', 'code' => 404];
        }
        $comments = $episode->comments()->latest('comment_date')->paginate(15, '*', 'page', $request['page']);
        return [
            'data' => CommentResource::collection($comments),
            'meta' => [
                'current_page' => $comments->currentPage(),
                'has_more_pages' => $comments->hasMorePages(),
                'next_page' => $comments->hasMorePages() ? $comments->currentPage() + 1 : null,
            ],
            'message' => 'Comments retrieved successfully',
            'code' => 200
        ];
    }

    // Get the authenticated user's comments for a specific episode.
    public function getMyComments($episode_id): array
    {
        if(is_null(Episode::query()->find($episode_id))) {
            return ['message' => 'Episode not found!', 'code' => 404];
        }
        $comments = Comment::query()
            ->where([
                'episode_id' => $episode_id,
                'user_id' => auth('api')->id()
            ])->latest('comment_date')->get();
        return ['data' => CommentResource::collection($comments), 'message' => 'Comments retrieved successfully', 'code' => 200];
    }

    // Add comment for specific episode.
    public function store($request, $episode_id): array
    {
        if(is_null(Episode::query()->find($episode_id))) {
            return ['message' => 'Episode not found!', 'code' => 404];
        }
        $comment = Comment::query()->create([
            'episode_id' => $episode_id,
            'user_id' => auth('api')->id(),
            'content' => $request['content']
        ]);
        return ['data' => new CommentResource($comment), 'message' => 'Comment created successfully', 'code' => 201];
    }

    // Update specific comment.
    public function update($request, $id): array
    {
        $comment = Comment::query()
            ->where([
                'id' => $id,
                'user_id' => auth('api')->id()
            ])->first();
        if(is_null($comment)) {
            if(!Comment::query()->find($id)) {
                return ['message' => 'Comment not found!', 'code' => 404];
            } else {
                return ['message' => 'Unauthorized!', 'code' => 401];
            }
        }

        $comment->update([
            'content' => $request['content']
        ]);
        return ['data' => new CommentResource($comment), 'message' => 'Comment updated successfully', 'code' => 200];
    }

    // Delete specific comment.
    public function destroyForStudent($id): array
    {
        $comment = Comment::query()
            ->where([
                'id' => $id,
                'user_id' => auth('api')->id()
            ])->first();
        if(is_null($comment)) {
            if(!Comment::query()->find($id)) {
                return ['message' => 'Comment not found!', 'code' => 404];
            } else {
                return ['message' => 'Unauthorized!', 'code' => 401];
            }
        }
        $comment->delete();
        return ['message' => 'Comment deleted successfully', 'code' => 200];
    }

    public function destroyForTeacher($id): array
    {
        $comment = Comment::query()->find($id);
        if(is_null($comment)) {
                return ['message' => 'Comment not found!', 'code' => 404];
        }
        if(!$comment->episode->course->where('teacher_id', auth('api')->id())->exists()) {
            return ['message' => 'Unauthorized!', 'code' => 401];
        }
        $comment->delete();
        return ['message' => 'Comment deleted successfully', 'code' => 200];
    }

    // Add Like to specific comment.
    public function addLikeToComment($id): array
    {
        $comment = Comment::query()->find($id);
        if(is_null($comment)) {
            return ['message' => 'Comment not found!', 'code' => 404];
        }
        if($comment->userLikes()->where('user_id', auth('api')->id())->exists()) {
            return ['message' => 'You\'ve already liked this comment!', 'code' => 401];
        }
        $comment->userLikes()->attach(auth('api')->id());
        $comment->update([
            'likes' => $comment->likes + 1,
        ]);
        return ['data' => new CommentResource($comment), 'message' => 'Comment liked successfully', 'code' => 200];
    }

    // Remove Like from specific comment.
    public function removeLikeFromComment($id): array
    {
        $comment = Comment::query()->find($id);
        if(is_null($comment)) {
            return ['message' => 'Comment not found!', 'code' => 404];
        }
        if(!$comment->userLikes()->where('user_id', auth('api')->id())->exists()) {
            return ['message' => 'You don\'t have a like for this comment!', 'code' => 404];
        }
        $comment->userLikes()->detach(auth('api')->id());
        $comment->update([
            'likes' => $comment->likes - 1,
        ]);
        return ['data' => new CommentResource($comment), 'message' => 'Comment unliked successfully', 'code' => 200];
    }
}
