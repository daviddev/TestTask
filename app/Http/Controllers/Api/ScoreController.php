<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Score\StoreRequest;
use App\Http\Resources\Score\ShowResource;
use App\Http\Resources\Score\ShowResourceCollection;
use App\Models\Link;
use App\Repositories\ScoreRepository;
use App\Services\Score;
use Illuminate\Http\JsonResponse;

class ScoreController extends Controller
{
    /**
     * UserController constructor.
     *
     * @param ScoreRepository $scoreRepository
     */
    public function __construct(private ScoreRepository $scoreRepository)
    {
        //
    }

    /**
     * Get last 3 scores.
     *
     * @param Link $link
     * @return JsonResponse
     */
    public function index(Link $link): JsonResponse
    {
        $scores = $this->scoreRepository->getLastThreeScores($link->user);
        return (new ShowResourceCollection($scores))->response();
    }

    /**
     * Store score.
     *
     * @param Link $link
     * @param StoreRequest $request
     * @param Score $score
     * @return JsonResponse
     */
    public function store(Link $link, StoreRequest $request, Score $score): JsonResponse
    {
        $number = $request->validated('number');
        $countedScore = $score->calculateScore($number);
        $score = $this->scoreRepository->storeScore($link->user, $countedScore, $number);

        return (new ShowResource($score))->response();
    }
}
