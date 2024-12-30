

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
    <title>Dashboard - userhome</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
                        <a href="/userhome" class="nav-link">
                            <span data-key="t-dashboards" style=" color: orange;" >Dashboards</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="modifierrecette" class="nav-link">
                            <span data-key="t-dashboards">Gérer Recette</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span data-key="t-dashboards">Avis</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span data-key="t-dashboards">Recette</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/user/consulter-list-recette" class="nav-link">
                            <span data-key="t-dashboards">Mes Recettes</span>
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
                            <h4 class="mb-sm-0">tous les recettes</h4>
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
                                                                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                                                        <h5 class="card-title" style="margin: 0;">{{ $recette->titre }}</h5>
                                                                        <!-- Display Average Rating -->
                                                                        @php
                                                                            // Calculate average rating only for approved rates
                                                                            $approvedRates = $recette->rates->where('status', 'approved');
                                                                            $averageRating = $approvedRates->avg('stars');
                                                                            $averageRatingRounded = round($averageRating); // Rounded to nearest integer
                                                                        @endphp
                                                                        <span style="margin: 0;">
                                                                            @if($averageRating)
                                                                                <!-- Loop through to display star icons -->
                                                                                @for($i = 1; $i <= 5; $i++)
                                                                                    @if($i <= $averageRatingRounded)
                                                                                        <i class="fa fa-star" style="color: gold;"></i> <!-- Filled star -->
                                                                                    @else
                                                                                        <i class="fa fa-star-o" style="color: gold;"></i> <!-- Empty star -->
                                                                                    @endif
                                                                                @endfor
                                                                            @else
                                                                                <span>(Aucune note)</span>
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                    <div class="card-body" style="height: 310px; width 300px;">
                                                                        <!-- Display Recette Image -->
                                                                        {{-- <p><strong>Image:</strong></p> --}}
                                                                        <img src="{{ asset('storage/' . $recette->image) }}" alt="{{ $recette->titre }}" width="220px" height="120px">
                                                                        <p>  </p>
                                                                        <p class="card-text"><strong>Ingrédients:</strong> {{ $recette->ingredients }}</p>
                                                                        <p class="card-text"><strong>Method de préparation:</strong> {{ $recette->methode_preparation }}</p>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <a href="{{ route('recette.details', $recette->id) }}" class="btn btn-info btn-sm">Afficher les détails</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <p>Aucune recette trouvée dans cette sous-catégorie.</p>
                                            @endif
                                        @endforeach
                                    @else
                                        <p>Aucune sous-catégorie trouvée pour cette catégorie.</p>
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