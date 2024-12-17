<html>
 
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.min.css') }}">
    <title>check recette and rate</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">


</head>
 
<body>
    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <div class="navbar-brand-box horizontal-logo"></div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown">
                            <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle">Profil</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <span class="align-middle">Déconnexion</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
 
    <div class="app-menu navbar-menu">
        <div class="navbar-brand-box">
            <a href="/Home" class="logo logo-dark">
                <span class="logo-lg">
                    <img src="/assets/images/logor.png" alt="" height="75" />
                </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>
        <div id="scrollbar">
            <div class="container-fluid">
                <ul class="navbar-nav" id="navbar-nav">
                    <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <span data-key="t-dashboards">Dashboards</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <span data-key="t-dashboards">Utilisateurs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/CategorieAdmin" class="nav-link">
                            <span data-key="t-dashboards">Gérer Catégorie</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/GestionRecette" class="nav-link">
                            <span data-key="t-dashboards">Gérer Recette</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/MyReclamations" class="nav-link">
                            <span data-key="t-dashboards">Avis</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/CategorieUser" class="nav-link">
                            <span data-key="t-dashboards">Recette</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/MesRecetteCons" class="nav-link">
                            <span data-key="t-dashboards">Mes Recette</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar-background"></div>
    </div>
    {{-- <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">recette details</h4>
                        </div>
                    </div>

                    <div class="container">
                        <h2>{{ $recette->titre }}</h2>
                        <p><strong>Ingrédients:</strong> {{ $recette->ingredients }}</p>
                        <p><strong>Status:</strong> {{ $recette->status }}</p>
                        <p><strong>Method of Preparation:</strong> {{ $recette->methode_preparation }}</p>
                        <p><strong>Additional Info:</strong> {{ $recette->informations_complementaire }}</p>
                        <p><strong>Created At:</strong> {{ $recette->created_at }}</p>
                        <p><strong>Updated At:</strong> {{ $recette->updated_at }}</p>
                        <a href="/user/consulter-list-recette" class="btn btn-primary">Back to List</a>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}

    <div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Recette Details</h4>
                    </div>
                </div>
            </div>

             <!-- Show success message -->
             @if(session('success'))
             <div class="alert alert-success alert-dismissible fade show" role="alert">
                 {{ session('success') }}
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>
         @endif
            <!-- end page title -->

            <div class="container mt-5">
                <div class="row">
                    <!-- Recette Details Section (Left side) -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h2>{{ $recette->titre }} </h2>
                                 <!-- Average Rating Inside Recipe Card -->
                             {{-- <strong>Average Rating:</strong>  --}}
                                <strong>
                                    {{ $averageRating ? number_format($averageRating, 1) : 'No ratings yet' }}/5
                                </strong>
                            </div>
                            <div class="card-body">
                                <p><strong>Ingrédients:</strong></p>
                                <p>{{ $recette->ingredients }}</p>
                                <p><strong>Method of Preparation:</strong></p>
                                <p>{{ $recette->methode_preparation }}</p>
            
                                <p><strong>Additional Info:</strong></p>
                                <p>{{ $recette->informations_complementaire }}</p>
            
                                <p><strong>Created At:</strong> {{ $recette->created_at }}</p>
                                <p><strong>Updated At:</strong> {{ $recette->updated_at }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="/userhome" class="btn btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
            
                    <!-- Rating Form Section (Right side) -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Rate This Recipe</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('rate.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="recette_id" value="{{ $recette->id }}">
            
                                    <!-- Stars -->
                                    <div class="mb-3">
                                        <label for="stars" class="form-label">Stars (1-5):</label>
                                        <input type="number" id="stars" name="stars" class="form-control" min="1" max="5" required>
                                    </div>
            
                                    <!-- Comment -->
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Comment (optional):</label>
                                        <textarea id="comment" name="comment" class="form-control" rows="4"></textarea>
                                    </div>
            
                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-success">Submit Rating</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
               
            </div>
            
            <!-- Display the Comments in a Message Box Style -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Comments</h4>
                        </div>
                        <div class="card-body">
                            @forelse($recette->rates as $rate)
                                <div class="alert alert-info mb-3">
                                    <!-- User Icon -->
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user-circle fa-2x mr-2"></i>
                                        <div>
                                            <p><strong>Comment:</strong> {{ $rate->comment ?? 'No comment' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>No comments yet for this recipe.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            
    </div>
</div>

                                    

  


</body>
</html>