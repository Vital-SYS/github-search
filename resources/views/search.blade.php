<!DOCTYPE html>
<html>
<head>
    <title>Поиск проектов на Github</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Поиск проектов на Github</h1>
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Введите текст" name="search">
                    <button class="btn btn-primary" type="submit">Поиск</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
