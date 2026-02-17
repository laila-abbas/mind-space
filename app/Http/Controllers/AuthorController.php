<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::with('user')->withCount('books')->has('books')->paginate(12);

        return view('authors.index', compact('authors'));
    }

    public function show(Author $author) {
        $author->load(['user', 'books']);
        
        return view('authors.show', compact('author'));
    }
}
