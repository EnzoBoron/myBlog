<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>dashboard</h1>

    @if ($user)
        <h2>{{ $user->name }}</h2>
    @else
        <h2>Visitor</h2>
    @endif

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <form action="/blog/look" method="get">
        @csrf
        <button type="submit">New</button>
    </form>

    @foreach ($articles as $article)
        <a href="/article/index/{{ $article->id }}" data-id="{{ $article->id }}">
            {{ $article->title . " By " . $article->user->name}}
        </a>
        <p> {{ $article->comments->sortByDesc('created_at')->first()?->content ?? 'Soyez le premier a reagir' }} </p>
        <p> {{ $article->comments->count() }} réponses</p>
        <p>{{ $article->created_at->format('d/m/Y à H:i') }}</p>
        <br />
    @endforeach
</body>
</html>