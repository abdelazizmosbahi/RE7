

<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.min.css') }}">
    <title>Admin - Manage Categories</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>*
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

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
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">userhome</h4>
                        </div>
                    </div>
                    

                    <div class="container mt-5">
                        <div class="row mt-4">
                            @foreach($categories as $category)
                                <div class="col-12 mb-3">
                                    <h4>{{ $category->titre }}</h4>
                    
                                    @if($category->sousCategories->count() > 0)
                                        @foreach($category->sousCategories as $sousCategory)
                                            <h5>{{ $sousCategory->titre }}</h5>
                    
                                            @if($sousCategory->recettes->count() > 0)
                                                <div class="row">
                                                    @foreach($sousCategory->recettes as $recette)
                                                        <!-- Check if the recette has 'accepted' status -->
                                                        @if($recette->status === 'acceptée')
                                                            <div class="col-md-4 mb-4">
                                                                <!-- Recipe Card -->
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h5 class="card-title">{{ $recette->titre }}</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <!-- Display Recette Image -->
                                                                        <p><strong>Recipe Image:</strong></p>
                                                                        <img src="{{ asset('storage/' . $recette->image) }}" alt="{{ $recette->titre }}" width="200">
                    
                                                                        <p class="card-text"><strong>Ingrédients:</strong> {{ $recette->ingredients }}</p>
                                                                        <p class="card-text"><strong>Method:</strong> {{ $recette->methode_preparation }}</p>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <a href="{{ route('recette.details', $recette->id) }}" class="btn btn-info btn-sm">View Details</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <p>No recipes found in this subcategory.</p>
                                            @endif
                                        @endforeach
                                    @else
                                        <p>No subcategories found for this category.</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
                                    

  

</body>
</html>