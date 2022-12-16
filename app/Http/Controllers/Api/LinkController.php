<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Link\ShowResourceCollection;
use App\Models\Link;
use App\Repositories\LinkRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class LinkController extends Controller
{
    /**
     * LinkController constructor.
     *
     * @param LinkRepository $repository
     */
    public function __construct(private LinkRepository $repository)
    {
        //
    }

    /**
     * @param Link $link
     * @return JsonResponse
     * @throws Exception
     */
    public function store(Link $link): JsonResponse
    {
        $user = $link->user;
        $this->repository->createLink($user, true);

        return (new ShowResourceCollection($user->manual_links))->response();
    }

    /**
     * @param Link $link
     * @return View|Factory|Application
     */
    public function show(Link $link): View|Factory|Application
    {
        $user = $link->user;
        $user->load('manual_links');

        return view('game', compact('link', 'user'));
    }

    /**
     * @param Link $currentLink
     * @param Link $link
     * @return JsonResponse
     */
    public function deactivateLink(Link $currentLink, Link $link): JsonResponse
    {
        $user = $currentLink->user;
        $this->repository->deactivateLink($link);

        return (new ShowResourceCollection($user->manual_links))->response();
    }
}
