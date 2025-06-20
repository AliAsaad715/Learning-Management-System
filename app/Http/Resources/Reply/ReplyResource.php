<?php

namespace App\Http\Resources\Reply;

use App\Traits\manipulateImagesTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'comment_id' => $this->comment_id,
            'content' => $this->content,
            'reply_date' => Carbon::parse($this->reply_date)->diffForHumans(),
            'likes' => $this->likes ? $this->likes : 0,
            'user' => [
                'id' => $this->user->id,
                'full_name' => $this->user->first_name. ' ' .$this->user->last_name,
                'profile_image_url' => $this->user->profile_image_url ? $this->get_image($this->user->profile_image_url, 'users') : null
            ]
        ];
    }
}
