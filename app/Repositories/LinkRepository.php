<?php

namespace App\Repositories;

use App\Models\Link;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;

class LinkRepository
{
    /**
     * @param User $user
     * @param bool $is_manual
     * @return Model
     * @throws Exception
     */
    public function createLink(User $user, bool $is_manual = false): Model
    {
        return $user->links()->create([
            'key' => Link::generateUniqueKey(),
            'expired_at' => now()->addDays(7),
            'is_manual' => $is_manual,
        ]);
    }

    /**
     * @param Link $link
     */
    public function deactivateLink(Link $link)
    {
        $link->update(['status' => Link::STATUS_INACTIVE]);
    }
}
