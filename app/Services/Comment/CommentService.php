<?php

namespace App\Services\Comment;

use App\Models\Comment;

class CommentService
{
    public function index($episode_id): array
    {
        $comments = Comment::query()->where('episode_id', $episode_id)->get();
        return ['data' => $comments, 'message' => 'Comments retrieved successfully', 'code' => 200];
    }

    public function store($request, $episode_id): array
    {
        $comment = Comment::query()->create([
            'episode_id' => $episode_id,
            'user_id' => auth('api')->id(),
            'content' => $request['content']
        ]);

        return ['data' => $comment, 'message' => 'Comment created successfully', 'code' => 201];
    }

    public function show($episode_id): array
    {
        $comment = Comment::query()->
        where([
            'episode_id' => $episode_id,
            'user_id' => auth('api')->id()
        ])->get();
        return ['data' => $comment, 'message' => 'Comments retrieved successfully', 'code' => 200];
    }

    public function update($request, $id): array
    {
        $comment = Comment::query()->findOrFail($id);
        $comment->update([
            'content' => $request['content']
        ]);
        return ['data' => $comment, 'message' => 'Comment updated successfully', 'code' => 200];
    }

    public function destroy($id): array
    {
        $comment = Comment::query()->findOrFail($id);
        $comment->delete();
        return ['message' => 'Comment deleted successfully', 'code' => 200];
    }
}
