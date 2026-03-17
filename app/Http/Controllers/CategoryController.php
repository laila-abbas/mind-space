<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;


class CategoryController extends Controller
{
    public function index() {
        $categories = Category::withCount('children')->whereNull('parent_id')->get();

        return view('categories.index', compact('categories'));
    }


    public function show(Category $category) {
        $subcategories = $category->children()->get();

        // category + its children
        $categoryIds = $subcategories->pluck('id')->push($category->id);

        // all books that belong to any category in the previous list
        $books = Book::withCatalogData()
            ->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
        });

        // subcategory filter 
        if ($subcategorySlug = request('subcategory')) {
            $books->whereHas('categories', function ($q) use ($subcategorySlug) {
                $q->where('slug', $subcategorySlug);
            });
        }

        $books = $books->paginate(12);

        return view('categories.show', compact('category', 'subcategories', 'books'));
    }
}
