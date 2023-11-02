<!DOCTYPE html>
<html>
<head>
    <title>Результаты поиска</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Результаты поиска:</h1>
            <p>Запрос: {{ session('searchString') }}</p>
        </div>
    </div>

    @if ($searchResult)
        <div class="row mt-4">
            <div class="col-md-12">
                <form action="{{ route('deleteSearch', ['id' => $searchResult->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Сбросить результаты поиска</button>
                </form>
            </div>
        </div>
    @endif

    <div class="row mt-4">
        <div class="col-md-12">
            <a href="{{ route('index') }}" class="btn btn-primary">Вернуться к поиску</a>
        </div>
    </div>

    <div class="row mt-4">
        @if ($results)
            @foreach($results['items'] as $result)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $result['name'] }}</h5>
                            <p class="card-text">Автор: {{ $result['owner']['login'] }}</p>
                            <p class="card-text">Кол-во звезд: {{ $result['stargazers_count'] }}</p>
                            <p class="card-text">Кол-во просмотров: {{ $result['watchers_count'] }}</p>
                            <a href="{{ $result['html_url'] }}" class="btn btn-primary">Перейти к проекту</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12">
                <p>Результаты не найдены.</p>
            </div>
        @endif
    </div>

    <div class="pagination mt-4 mb-4">
        @if ($currentPage > 1)
            <a class="btn btn-primary"
               href="{{ route('results', ['page' => $currentPage - 1, 'searchString' => $searchString]) }}">Назад</a>
        @endif

        <span class="page-number m-auto">{{ $currentPage }}</span>

        @if ($currentPage < $totalPages)
            <a class="btn btn-primary"
               href="{{ route('results', ['page' => $currentPage + 1, 'searchString' => $searchString]) }}">Вперед</a>
        @endif
    </div>
</div>
</body>
</html>
