<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordUpdateRequest;
use App\Http\Resources\WordResource;
use App\Models\Word;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class WordController
 * @package App\Http\Controllers
 */
class WordController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return WordResource::collection(Word::all());
    }

    /**
     * @param Word $word
     * @return WordResource
     */
    public function show(Word $word): WordResource
    {
        return new WordResource($word);
    }

    /**
     * @param WordUpdateRequest $request
     * @param Word $word
     * @return WordResource
     */
    public function update(WordUpdateRequest $request, Word $word): WordResource
    {
        $word->update($request->all());

        return new WordResource($word);
    }

    /**
     * @param Word $word
     * @return WordResource
     * @throws Exception
     */
    public function destroy(Word $word): WordResource
    {
        $word->delete();

        return new WordResource($word);
    }
}
