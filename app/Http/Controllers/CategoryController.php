<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index() {
        $categories = Category::withCount('children')->whereNull('parent_id')->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category) {

        if ($category->children()->exists()) {
            $subcategories = $category->children()->withCount('books')->get();
            
            return view('categories.show', ['category' => $category, 'subcategories' => $subcategories]);
       }
       
       $books = $category->books()->withCatalogData()->paginate(12);

       return view('categories.show', compact('category', 'books'));
    }
}
