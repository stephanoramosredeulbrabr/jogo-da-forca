<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordUpdateRequest;
use App\Http\Resources\WordResource;
use Illuminate\Http\Request;
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
        return WordResource::collection(Word::with('category')->get());
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

    /**
     * @param Request $request
     */

    public function findLetter(Request $request){
        $id = $request->get('id');
        $letter = strtoupper($request->get('letter'));
        $word  = Word::find($id)->name;
        $word  = strtoupper(preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$word));
        $letters = str_split($word);
        $positions = array_keys($letters,$letter);
        return $positions;

    }
}
