<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(Request $request) {
        $query = Book::with('user');

        if ($request->author) {
            $query->where('author', 'like', '%' . $request->author . '%');
        }

        if ($request->rating) {
            $query->where('rating', $request->rating);
        }

        if ($request->date == 'newest') {
            $query->orderBy('created_at', 'desc');
        }

        $books = $query->paginate(8);

        return view('landing', compact('books'));
    }
}
