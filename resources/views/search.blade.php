@extends('layout')

@section('title', 'Поиск проектов на Github')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-4">Поиск проектов на Github</h1>
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Введите текст" name="search" value="{{ old('search') }}">
                    <button class="btn btn-outline-primary" type="submit">Поиск</button>
                </div>
                @if ($errors->has('search'))
                    <small class="text-danger">{{ $errors->first('search') }}</small>
                @endif
            </form>
            <p class="lead">Примеры поисковых запросов: "laravel", "sqlite", "php"</p>
            <p class="text-muted">Пожалуйста, используйте ограниченное число запросов для поиска в соответствии с API ограничениями.</p>
        </div>
    </div>
@endsection
