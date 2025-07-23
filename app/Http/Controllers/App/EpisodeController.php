<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\Episode\CreateEpisodeRequest;
use App\Http\Requests\Episode\UpdateEpisodeRequest;
use App\Models\Episode;
use App\Models\User;
use App\Responses\Response;
use App\Services\Episode\EpisodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class EpisodeController extends Controller
{
    private EpisodeService $episodeService;

    public function __construct(EpisodeService $episodeService)
    {
        $this->episodeService = $episodeService;
    }

    public function getToTeacher($course_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->episodeService->getToTeacher($course_id);
            if($data['code'] == 404) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($message);
        }
    }

    public function getToStudent($course_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->episodeService->getToStudent($course_id);
            if($data['code'] == 404) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($message);
        }
    }

    public function store(CreateEpisodeRequest $request, $course_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->episodeService->store($request->validated(), $course_id);
            if($data['code'] == 403 || $data['code'] == 404) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($message);
        }
    }

    public function update(UpdateEpisodeRequest $request, $id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->episodeService->update($request->validated(), $id);
            if($data['code'] == 403 || $data['code'] == 404) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($message);
        }
    }

    public function showToTeacher($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->episodeService->showToTeacher($id);
            if($data['code'] == 404) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($message);
        }
    }

    public function showToStudent($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->episodeService->showToStudent($id);
            if($data['code'] == 403 || $data['code'] == 404) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($message);
        }
    }

    public function destroy($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->episodeService->destroy($id);
            if($data['code'] == 403 || $data['code'] == 404) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success([], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($message);
        }
    }

    // Add Like to specific episode.
    public function addLikeToEpisode($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->episodeService->addLikeToEpisode($id);
            if($data['code'] == 404 || $data['code'] == 409 || $data['code'] == 403) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($message);
        }
    }

    // Remove Like from specific episode.
    public function removeLikeFromEpisode($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->episodeService->removeLikeFromEpisode($id);
            if($data['code'] == 404) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($message);
        }
    }

    public function finish_episode($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->episodeService->finish_episode($id);
            if($data['code'] == 409) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success([], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($message);
        }
    }
}
