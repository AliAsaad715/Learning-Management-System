<?php

namespace App\Http\Requests\Episode;

use App\Rules\ConsecutiveEpisodeNumber;
use App\Rules\QuestionsAreSequential;
use App\Traits\HandlesFailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class EpisodeRequest extends FormRequest
{
    use HandlesFailedValidationTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'episode_number' => ['required','integer', new ConsecutiveEpisodeNumber()],
            'video_url' => 'required|file|mimetypes:video/mp4,video/quicktime|max:102400',
            'image_url' => 'required|image|mimes:jpeg,png,bmp,jpg,gif,svg|max:2048',
        ];
    }
}
