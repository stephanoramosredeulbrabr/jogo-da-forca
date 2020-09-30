<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerStoreRequest;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Http\Resources\AnswerResource;
use App\Http\Resources\QuestionResource;
use App\Models\Answer;
use App\Models\Question;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class QuestionController
 * @package App\Http\Controllers
 */
class QuestionController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return QuestionResource::collection(Question::all());
    }

    /**
     * @param QuestionStoreRequest $request
     * @return QuestionResource
     */
    public function store(QuestionStoreRequest $request): QuestionResource
    {
        return new QuestionResource(Question::query()->create($request->all()));
    }

    /**
     * @param Question $question
     * @return QuestionResource
     */
    public function show(Question $question): QuestionResource
    {
        return new QuestionResource($question);
    }

    /**
     * @param QuestionUpdateRequest $request
     * @param Question $question
     * @return QuestionResource
     */
    public function update(QuestionUpdateRequest $request, Question $question): QuestionResource
    {
        $question->update($request->all());

        return new QuestionResource($question);
    }

    /**
     * @param Question $question
     * @return QuestionResource
     * @throws Exception
     */
    public function destroy(Question $question): QuestionResource
    {
        $question->delete();

        return new QuestionResource($question);
    }

    /**
     * @param Question $question
     * @return AnonymousResourceCollection
     */
    public function indexAnswer(Question $question): AnonymousResourceCollection
    {
        return AnswerResource::collection($question->answers()->get());
    }

    /**
     * @param AnswerStoreRequest $request
     * @param Question $question
     * @return AnswerResource
     */
    public function storeAnswer(AnswerStoreRequest $request, Question $question): AnswerResource
    {
        $word = new Answer($request->all());
        $word->question()->associate($question);
        $word->save();

        return new AnswerResource($word);
    }
}
