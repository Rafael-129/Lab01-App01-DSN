<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h1>{{ $post->title }}</h1>
    <p class="text-muted">Publicado: {{ $post->published_at }}</p>
    <div class="mb-3">{!! nl2br(e($post->body)) !!}</div>
    <a class="btn btn-secondary" href="{{ route('posts.index') }}">Volver</a>
</body>
</html>


