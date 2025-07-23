<?php

namespace App\Http\Resources\Episode;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EpisodeWithDetailsResource extends JsonResource
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
            'title' => $this->title,
            'episode_number' => $this->episode_number,
            'video_url' => asset(Storage::url($this->video_url)),
            'image_url' => asset(Storage::url($this->image_url)),
            'duration' => $this->formatted_duration,
            'views' => $this->views ? $this->views : 0,
            'likes' => $this->likes ? $this->likes : 0,
            'is_watched' => (bool)$this->students()->whereUserId(auth()->id())->exists(),
            'is_liked' => (bool)$this->userLikes()->whereUserId(auth()->id())->exists(),
        ];
    }
}
