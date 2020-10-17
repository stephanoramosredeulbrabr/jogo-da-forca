<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Requests\WordStoreRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\WordResource;
use App\Models\Category;
use App\Models\Word;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function indexOnlyWithWords(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::query()->whereHas('words')->get());
    }

    /**
     * @param CategoryStoreRequest $request
     * @return CategoryResource
     */
    public function store(CategoryStoreRequest $request): CategoryResource
    {
        return new CategoryResource(Category::query()->create($request->all()));
    }

    /**
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    /**
     * @param CategoryUpdateRequest $request
     * @param Category $category
     * @return CategoryResource
     */
    public function update(CategoryUpdateRequest $request, Category $category): CategoryResource
    {
        $category->update($request->all());

        return new CategoryResource($category);
    }

    /**
     * @param Category $category
     * @return CategoryResource
     * @throws Exception
     */
    public function destroy(Category $category): CategoryResource
    {
        $category->delete();

        return new CategoryResource($category);
    }

    /**
     * @param Category $category
     * @return AnonymousResourceCollection
     */
    public function indexWord(Category $category): AnonymousResourceCollection
    {
        return WordResource::collection($category->words()->get());
    }

    /**
     * @param $id_category
     * @return WordResource
     */

    public function getWord($id_category = 0){
        if($id_category){
            $word = Category::find($id_category)->words()->selectRaw('id, name as size')->inRandomOrder()->first();
        }else{
            $word = Word::selectRaw('id, name as size')->inRandomOrder()->first();
        }
        $word->size = mb_strlen($word->size);
        return new WordResource($word);

    }

    /**
     * @param WordStoreRequest $request
     * @param Category $category
     * @return WordResource
     */
    public function storeWord(WordStoreRequest $request, Category $category): WordResource
    {
        $word = new Word($request->all());
        $word->category()->associate($category);
        $word->save();
        $word->load('category');

        return new WordResource($word);
    }
}
