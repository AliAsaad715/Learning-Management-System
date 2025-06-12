<?php

namespace App\Services\Reply;

use App\Models\Reply;

class ReplyService
{
    public function index($comment_id): array
    {
        $replies = Reply::query()->where('comment_id', $comment_id)->get();
        return ['data' => $replies, 'message' => 'Replies retrieved successfully', 'code' => 200];
    }

    public function store($request, $comment_id): array
    {
        $reply = Reply::query()->create([
            'comment_id' => $comment_id,
            'user_id' => auth('api')->id(),
            'content' => $request['content']
        ]);

        return ['data' => $reply, 'message' => 'Reply created successfully', 'code' => 201];
    }

    public function show($comment_id): array
    {
        $reply = Reply::query()->
        where([
            'comment_id' => $comment_id,
            'user_id' => auth('api')->id()
        ])->get();
        return ['data' => $reply, 'message' => 'Replies retrieved successfully', 'code' => 200];
    }

    public function update($request, $id): array
    {
        $reply = Reply::query()->findOrFail($id);
        $reply->update([
            'content' => $request['content']
        ]);
        return ['data' => $reply, 'message' => 'Reply updated successfully', 'code' => 200];
    }

    public function destroy($id): array
    {
        $reply = Reply::query()->findOrFail($id);
        $reply->delete();
        return ['message' => 'Reply deleted successfully', 'code' => 200];
    }
}
