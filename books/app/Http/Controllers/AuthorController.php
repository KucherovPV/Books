<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function authors()
    {
        $authors = Authors::get();
        return view('author', compact('authors'));
    }

    public function addAuthor(Request $request)
    {
        $author = new Authors();
        $author->fname = $request->input('fname');
        $author->lname = $request->input('lname');
        $author->mname = $request->input('mname');
        $author->save();
        return redirect('/authors');
    }
    public function deleteAuthor($id)
    {
        Authors::where('id', $id)->delete();
        return redirect('/authors');
    }

    public function editBook(Request $request, $id)
    {
        $author = Books::find($id); // Находим книгу по идентификатору
        $author->fname = $request->input('fname');
        $author->lname = $request->input('lname');
        $author->mname = $request->input('mname');
        $author->save(); // Сохраняем обновленные данные
    }
}
