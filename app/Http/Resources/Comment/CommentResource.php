<?php

namespace App\Http\Resources\Comment;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'num_of_replies' => $this->replies->count(),
            'comment_date' => Carbon::parse($this->comment_date)->diffForHumans(),
            'is_liked' => (bool)auth('api')->user()->likeComment()->where('comment_id', $this->id)->exists(),
            'likes' => $this->likes ? $this->likes : 0,
            'commenter' => [
                'id' => $this->user->id,
                'full_name' => $this->user->first_name . ' ' . $this->user->last_name,
                'profile_image_url' => $this->user->profile_image_url ? asset(Storage::url("img/users/{$this->user->profile_image_url}")) : null,
            ]
        ];
    }
}
