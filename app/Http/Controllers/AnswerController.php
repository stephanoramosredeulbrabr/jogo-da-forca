<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerUpdateRequest;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class AnswerController
 * @package App\Http\Controllers
 */
class AnswerController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return AnswerResource::collection(Answer::all());
    }

    /**
     * @param Answer $answer
     * @return AnswerResource
     */
    public function show(Answer $answer): AnswerResource
    {
        return new AnswerResource($answer);
    }

    /**
     * @param AnswerUpdateRequest $request
     * @param Answer $answer
     * @return AnswerResource
     */
    public function update(AnswerUpdateRequest $request, Answer $answer): AnswerResource
    {
        $answer->update($request->all());

        return new AnswerResource($answer);
    }

    /**
     * @param Answer $answer
     * @return AnswerResource
     * @throws Exception
     */
    public function destroy(Answer $answer): AnswerResource
    {
        $answer->delete();

        return new AnswerResource($answer);
    }
}
