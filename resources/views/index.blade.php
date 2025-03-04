<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>My Blog</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <link href="css/styles.css" rel="stylesheet" />
        <style>
            .custom-search {
                background-color: transparent !important;
                height: 45px;
                font-size: 14px;
            }
        </style>
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

        <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>My Blog</h1>
                            <span class="subheading">Presentation blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="d-flex justify-content-center mb-5">
            <div class="input-group w-50">
                <span class="input-group-text bg-light border-0 custom-search">
                <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control rounded-pill px-3 custom-search" id="searchInput" placeholder="Rechercher..." aria-label="Search">
            </div>
        </div>

        <div class="position-fixed bottom-0 end-0 p-3">
            <form action="/blog/look" method="get">
                <button type="submit" class="btn btn-primary text-uppercase">+Ajouter</button>
            </form>
        </div>

        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7 text-center">
                    @foreach ($articles as $article)
                        <div class="post-preview article">
                            <div class="post-preview">
                                <a href="/article/index/{{ $article->id }}" data-id="{{ $article->id }}" class="post-title">
                                    <h2>{{ $article->title }}</h2>
                                    <h3 class="post-subtitle"> 
                                        {{ $article->comments->sortByDesc('created_at')->first()?->content ?? 'Soyez le premier à réagir' }} 
                                    </h3>
                                </a>
                                <p>{{ $article->comments->count() }} réponses</p>
                                <p class="post-meta">
                                    Écrit le {{ $article->created_at->format('d/m/Y à H:i') }} par {{ $article->user->name }}
                                </p>
                                <br />
                            </div>
                        </div>
                    @endforeach

                    <div class="mb-5">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>

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
                        <div class="small text-center text-muted fst-italic">Copyright &copy; My Blog 2025</div> 
                        <div class="small text-center"><a href="/deleteAccount">Supprimer mon compte</a></div>
                        <div class="small text-center"><a href="/logout">Me déconecter</a></div>
                    </div>
                </div>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="js/search.js"></script>
    </body>
</html>
