<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $books = Book::where('user_id', Auth::id())->latest()->paginate(4);
        if (request()->ajax()) {
            return view('books.index', compact('books'))->render();
        }
        return view('books.index', compact('books'));
    }

    public function create()
    {
        if (request()->ajax()) {
            return view('books.create')->render();
        }
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'nullable',
            'rating' => 'required|integer|min:1|max:5',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Book::create($data);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);
        if (request()->ajax()) {
            return view('books.edit', compact('book'))->render();
        }
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'nullable',
            'rating' => 'required|integer|min:1|max:5',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $book->update($data);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        $book->delete();
        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}
