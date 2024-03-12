@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 ">
                <h1>Список Книг</h1>
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="non-clickable">
                    <tr>
                        <th>Жанр</th>
                        <th>Название</th>
                        <th>Автор</th>
                        <th>Издательство</th>
                        <th>Год издания</th>
                        <th>Рейтинг популярности</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($genresList as $genre)
                        <tr>
                            <td colspan="6" class="table-active non-clickable">{{ $genre->name }}</td>
                        </tr>
                        @foreach($genre->books as $book)
                            <tr @auth class="cursor-pointer" @endauth
                            <tr data-book-id="{{ $book->id }}">
                                <td>{{$genre->name}}</td>
                                <td>{{ $book->name }}</td>
                                <td>{{trim($book->author->lname).' '.mb_substr($book->author->fname, 0, 1, 'UTF-8').'. '. mb_substr($book->author->mname, 0, 1, 'UTF-8').'. '}}</td>
                                <td>{{ $book->publishingHouse->name}}</td>
                                <td>{{ $book->year }}</td>
                                <td>{{ $book->issuance}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
                @auth
                    <div class="modal" tabindex="-1" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Книга</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"
                                            id="closeModalForm" ></button>
                                </div>
                                <div class="modal-body">
                                    <p><span class="modal-label">ID:</span><span id="modalId"></span></p>
                                    <p><span class="modal-label">Жанр:</span> <span id="modalGenre"></span></p>
                                    <p><span class="modal-label">Название:</span> <span id="modalBook"></span></p>
                                    <p><span class="modal-label">Автор:</span> <span id="modalAuthor"></span></p>
                                    <p><span class="modal-label">Издательство:</span> <span
                                            id="modalPublishingHouse"></span></p>
                                    <p><span class="modal-label">Год издания:</span> <span id="modalYear"></span></p>
                                    <p><span class="modal-label">Рейтинг:</span> <span id="modalRating"></span></p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            id="closeModalButton">Закрыть
                                    </button>
                                    @csrf
                                    <button type="submit" class=" btn btn-primary" id="edit">Редактировать запись</button>
                                    <button type="submit" class=" btn btn-danger" id="deleteButton">Удалить запись</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-4 mt-5" id="containerAdd">
                <button id="toggleButton" class="btn btn-primary mt-2">Добавить книгу</button>
                <form id="addBookForm" method="POST" action="{{route('addBook')}}" class="hidden">
                    @csrf
                    <div class="form-group">
                        <label for="genre">Жанр</label>
                        <input type="text" class="form-control" name="genre" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Название</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Автор</label>
                        <input type="text" class="form-control" name="author" required>
                    </div>
                    <div class="form-group">
                        <label for="publishingHouse">Издательство</label>
                        <input type="text" class="form-control" name="publishingHouse" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Год издания</label>
                        <input type="text" class="form-control" name="year" required>
                    </div>
                    <div class="form-group">
                        <label for="issuance">Рейтинг популярности</label>
                        <input type="text" class="form-control" name="issuance" required>
                    </div>
                    <div class="form-group mt-2 mb-3">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
            @endauth
        </div>
    </div>
@endsection




