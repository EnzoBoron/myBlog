<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog - {{ $article->title }}</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="/dashboard">My Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/dashboard">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/about">A propos</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    @if ($article->image_path)
        <img src="{{ asset('storage/' . $article->image_path) }}">
    @endif
    <header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1>{{ $article->title }}</h1>
                            <h2 class="subheading">{{ $article->content }}</h2>
                            <span class="meta">
                                Posted by {{ $article->user->name }}
                                on August 24, 2023
                            </span>
                            
                            @if ($user && (($article->user->id == $user->id) || ($user->getRoleNames()->first() == "modo")))
                                <form action=" {{ route('article.destroy', $article->id) }} " method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit">Remove</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </header>
   
        @foreach ($article->comments as $comment)
    <article class="mb-4">
        <div class="container px-4 px-lg-5 d-flex justify-content-center">
            <div class="row gx-4 gx-lg-5 justify-content-center w-100">
                <div class="col-md-10 col-lg-8 col-xl-7 text-center">
                    <h3>{{ $comment->user->name }}</h3>
                    <p>{{ $comment->content }}</p>

                    @if($comment->image_path)
                        <img src="{{ asset('storage/' . $comment->image_path ) }}" class="img-fluid rounded my-3" alt="Comment Image">
                    @endif

                    <p class="text-muted">{{ $comment->created_at->format('d/m/Y à H:i') }}</p>

                    <form action="/comments/{{$comment->id}}/react" method="post" class="d-flex justify-content-center gap-2">
                        @csrf
                        <button type="submit" name="type" value="love" class="btn btn-outline-danger">❤️ {{ $comment->reactions->where('type', 'love')->count() }}</button>
                        <button type="submit" name="type" value="like" class="btn btn-outline-primary">👍 {{ $comment->reactions->where('type', 'like')->count() }}</button>
                        <button type="submit" name="type" value="laugh" class="btn btn-outline-warning">😂 {{ $comment->reactions->where('type', 'laugh')->count() }}</button>
                        <button type="submit" name="type" value="cry" class="btn btn-outline-info">😭 {{ $comment->reactions->where('type', 'cry')->count() }}</button>
                    </form>

                    @if ($user && (($comment->user->id == $user->id) || ($user->getRoleNames()->first() == "modo")))
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </article>
@endforeach

    

    <div class="container d-flex justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-md-8 col-lg-6">
            <form action="/articles/{{ $article->id }}/comment" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-3 align-items-center">
                @csrf
                <textarea name="content" id="content" class="form-control" rows="4" placeholder="Votre commentaire..."></textarea>
                <input type="file" name="image" class="form-control">
                <button type="submit" class="btn btn-primary w-50">Send</button>
            </form>
        </div>
    </div>
</div>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif
    
    <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="mailto:enzo.boron.pro@gmail.com">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-envelope fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.linkedin.com/in/enzo-boron/">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-linkedin fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://github.com/EnzoBoron?tab=repositories">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2023</div>
                    </div>
                </div>
            </div>
        </footer>
</body>
</html>