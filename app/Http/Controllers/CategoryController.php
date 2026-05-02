<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use App\Services\CatalogSearchService;
use App\DTOs\SearchContext;


class CategoryController extends Controller
{
    public function index() {
        $categories = Category::withCount('children')->whereNull('parent_id')->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Request $request, Category $category, CatalogSearchService $search) {
        $subcategories = $category->children()->get();
        $categorySlugs = $subcategories->pluck('slug')->push($category->slug)->values()->toArray();
        $selectedCategories = $request->filled('subcategory')
            ? [$request->subcategory]
            : $categorySlugs;

        $baseQuery = Book::withCatalogData()
            ->whereHas('categories', function ($q) use ($selectedCategories) {
                $q->whereIn('slug', $selectedCategories);
            });

        $books = $search->resolve(new SearchContext(
            query: $request->query('q'),
            userFilters: $request->only(['language', 'format', 'price_max', 'published_from']),
            contextFilters: ['category' => $selectedCategories],
            page: $request->input('page', 1),
            perPage: 12,
            baseQuery: $baseQuery,
        ));

        return view('categories.show', compact('category', 'subcategories', 'books'));
    }
}
