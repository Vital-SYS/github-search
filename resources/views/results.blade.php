@extends('layout')

@section('title', 'Результаты поиска')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="display-4">Результаты поиска:</h1>
            <p class="lead">Запрос: {{ session('searchString') }}</p>
        </div>
    </div>

    @if ($searchResult)
        <div class="row mt-4 d-flex justify-content-between">
            <div class="col-md-6">
                <a href="{{ route('index') }}" class="btn btn-outline-primary">Вернуться к поиску</a>
            </div>
            <div class="col-md-6 text-end">
                <form action="{{ route('delete_search', ['id' => $searchResult->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger" type="submit">Сбросить результаты поиска</button>
                </form>
            </div>
        </div>
    @endif

    <div class="row mt-4">
        @if ($results)
            @foreach($results['items'] as $result)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $result['name'] }}</h5>
                            <img src="{{ $result['owner']['avatar_url'] }}" alt="Avatar" class="avatar">
                            <p class="author mb-2">{{ $result['owner']['login'] }}</p>
                            <div class="star-watch">
                                <p class="card-text">Кол-во звезд: {{ $result['stargazers_count'] }}</p>
                                <p class="card-text mb-4">Кол-во наблюдателей: {{ $result['watchers_count'] }}</p>
                            </div>
                            <a href="{{ $result['html_url'] }}" class="btn btn-outline-primary btn-go-to-project">Перейти
                                к проекту</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">Результаты не найдены.</div>
            </div>
        @endif
    </div>

    <div class="pagination mt-4 mb-4">
        @if ($currentPage > 2)
            <a class="btn btn-outline-primary me-3"
               href="{{ route('results', ['page' => 1, 'searchString' => $searchString]) }}">В начало</a>
        @endif
        @if ($currentPage > 1)
            <a class="btn btn-outline-primary"
               href="{{ route('results', ['page' => $currentPage - 1, 'searchString' => $searchString]) }}"><- Назад</a>
        @endif

        <div class="page-number m-auto">
            Страница {{ $currentPage }} из {{ $totalPages }}
        </div>

        @if ($currentPage < $totalPages)
            <a class="btn btn-outline-primary"
               href="{{ route('results', ['page' => $currentPage + 1, 'searchString' => $searchString]) }}">Вперед -></a>
        @endif

        @if ($currentPage < $totalPages - 1)
            <a class="btn btn-outline-primary ms-3"
               href="{{ route('results', ['page' => $totalPages, 'searchString' => $searchString]) }}">В конец</a>
        @endif
    </div>


@endsection
