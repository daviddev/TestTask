<?php

namespace App\Http\Resources\Score;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $number
 * @property float $score
 * @property boolean $is_win
 * @property Carbon $created_at
 */
class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'number' => $this->number,
            'score' => (float)$this->score,
            'is_win' => $this->is_win,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
