@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h1>Авторы</h1>
                <table class="table table-bordered table-hover" id="dataAuthorTable">
                    <tr>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                    </tr>
                    <tbody>

                    @foreach($authors as $author)
                            <tr @auth class="cursor-pointer" @endauth
                            <tr data-author-id="{{ $author->id }}">
                                <td>{{$author->lname}}</td>
                                <td>{{ $author->fname }}</td>
                                <td>{{ $author->mname }}</td>
                    @endforeach
                    </tbody>
                </table>
                @auth
                    <div class="modal" tabindex="-1" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Автор</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"
                                            id="closeModalForm" ></button>
                                </div>
                                <div class="modal-body">
                                    <p><span class="modal-label">ID:</span><span id="modalId"></span></p>
                                    <p><span class="modal-label">Фамилия:</span> <span id="modalLname"></span></p>
                                    <p><span class="modal-label">Имя:</span> <span id="modalFname"></span></p>
                                    <p><span class="modal-label">Отчество:</span> <span id="modalMname"></span></p>
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
                <button id="toggleButton" class="btn btn-primary mt-2">Добавить автора</button>
                <form id="addBookForm" method="POST" action="{{route('addAuthor')}}" class="hidden">
                    @csrf
                    <div class="form-group">
                        <label for="lname">Фамилия</label>
                        <input type="text" class="form-control" name="lname" required>
                    </div>
                    <div class="form-group">
                        <label for="fname">Имя</label>
                        <input type="text" class="form-control" name="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="mname">Отчество</label>
                        <input type="text" class="form-control" name="mname" required>
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
