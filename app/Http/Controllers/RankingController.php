<?php

namespace App\Http\Controllers;

use App\Http\Requests\RankingStoreRequest;
use App\Http\Resources\RankingResource;
use App\Models\Ranking;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */

class RankingController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return RankingResource::collection(Ranking::orderBy('score','DESC')->limit(10)->get());
    }

    /**
     * @param RankingStoreRequest $request
     * @return RankingResource
     */
    public function store(RankingStoreRequest $request): RankingResource
    {
        return new RankingResource(Ranking::query()->create($request->all()));
    }

}
