<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use App\Models\AuthorModel;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function spa()
    {
        $books = BookModel::with('authors')->get();
        $authors = AuthorModel::all();

        return view('bookmanager', compact('books', 'authors'));
    }

    // Store a new book and attach authors
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_year' => 'nullable|integer',
            'authors' => 'array',
            // 'authors.*' => 'integer|exists:authors,id',
        ]);

        $book = BookModel::create($validated);
        $book->authors()->attach($validated['authors'] ?? []);

        return redirect()->route('books.spa')->with('success', 'Book created successfully.');
    }

    // Update an existing book
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_year' => 'nullable|integer',
            'authors' => 'array',
        ]);

        $book = BookModel::findOrFail($id);
        $book->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'published_year' => $validated['published_year'] ?? null,
        ]);

        $book->authors()->sync($validated['authors'] ?? []);

        return redirect()->route('books.spa')->with('success', 'Book updated successfully.');
    }

    // Delete a book
    public function destroy($id)
    {
        $book = BookModel::findOrFail($id);
        $book->delete();

        return redirect()->route('books.spa')->with('success', 'Book deleted.');
    }
}
