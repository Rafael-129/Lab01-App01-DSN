<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h1>Editar Post</h1>
    <form method="POST" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}">
            @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Contenido</label>
            <textarea name="body" class="form-control" rows="6">{{ old('body', $post->body) }}</textarea>
            @error('body')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha publicación (opcional)</label>
            <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}">
            @error('published_at')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-primary">Actualizar</button>
        <a class="btn btn-secondary" href="{{ route('posts.index') }}">Volver</a>
    </form>
</body>
</html>


