<?php

namespace App\Http\Resources\Comment;

use App\Traits\manipulateImagesTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    use manipulateImagesTrait;
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
            'likes' => $this->likes ? $this->likes : 0,
            'user' => [
                'id' => $this->user->id,
                'full_name' => $this->user->first_name. ' ' .$this->user->last_name,
                'profile_image_url' => $this->user->profile_image_url ? $this->get_image($this->user->profile_image_url, 'users') : null,
            ]
        ];
    }
}
