<?php

namespace App\Http\Resources\Link;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $url
 * @property string $status
 * @property Carbon $expired_at
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
            'id' => $this->id,
            'status' => $this->status,
            'expired_at' => $this->expired_at,
            'url' => $this->url,
        ];
    }
}
