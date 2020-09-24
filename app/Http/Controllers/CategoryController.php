<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
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
}
