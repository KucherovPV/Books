<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use App\Models\Genres;
use App\Models\PublishingHouses;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function table()
    {
        $genresList = Genres::get();
        return view('index', compact('genresList'));
    }

    public function addBook(Request $request)
    {
        $model = new Books();
        $model->genre_id = Genres::where('name', $request->input('genre'))->first()->id;
        $model->name = $request->input('name');
        $model->author_id = Authors::where('lname',$request->input('author'))->first()->id;
        $model->publishing_house_id = PublishingHouses::where('name', $request->input('publishingHouse'))->first()->id;
        $model->issuance = $request->input('issuance');
        $model->year = $request->input('year');
        $model->save();
        return redirect('/');
    }
    public function deleteBook($id)
    {
        Books::where('id', $id)->delete();
        return redirect('/');
    }

    public function editBook(Request $request, $id)
    {
        $author = explode(' ',$request->input('author'));
        $book = Books::find($id); // Находим книгу по идентификатору
        $book->genre_id = Genres::where('name',$request->input('genre'))->first()->id;
        $book->name = $request->input('book');
        $book->author_id = Authors::where('lname',$author[0])->first()->id;
        $book->publishing_house_id = PublishingHouses::where('name',$request->input('publishingHouse'))->first()->id;
        $book->year = $request->input('year');
        $book->issuance = $request->input('rating');
        $book->save(); // Сохраняем обновленные данные
        //return response()->json(['message' => 'Данные успешно обновлены']);
   }
}
