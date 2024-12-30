<!DOCTYPE html>
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
                        <a href="/admin/categorie" class="nav-link">
                            <span data-key="t-dashboards">Gérer Catégorie</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/souscategorie" class="nav-link">
                            <span data-key="t-dashboards" style=" color: orange;">Gérer Sous-Catégorie</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/consulter-list-recette" class="nav-link">
                            <span data-key="t-dashboards">Gérer Recette</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/rates" class="nav-link">
                            <span data-key="t-dashboards">Avis</span>
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
                            <h4 class="mb-sm-0">Sous Catégorie details</h4>
                        </div>
                    </div>
                </div>
<!-- Liste des catégories -->
<div id="all-categories-list" class="col-xl-8"></div>
<div id="category-details"></div>
                                    

  
<!-- Category Details Section -->
<div id="get-category-result" class="mt-4">
    <!-- Detailed information about a clicked category will be displayed here -->
</div>
                 <div class="col-xl-4">
                    <div>
                       
    <div class="container">
        <div class="card">
            <div class="card-header">
              
                
                <div class="container">
                    <h1>Sous-Catégorie Details</h1>
                
                    <div class="card">
                        <div class="card-body">
                            <h3>{{ $sousCategorie->titre }}</h3>
                
                            <!-- Display the associated category -->
                            <p><strong>Category:</strong> {{ $sousCategorie->categorie ? $sousCategorie->categorie->titre : 'No category assigned' }}</p>
                
                            <!-- Display the image if available -->
                            @if ($sousCategorie->image)
                                <img src="{{ asset('storage/' . $sousCategorie->image) }}" alt="{{ $sousCategorie->titre }}" class="img-fluid" style="max-width: 200px;">
                            @else
                                <p>No image available.</p>
                            @endif
                
                            {{-- <p><strong>Description:</strong> {{ $sousCategorie->description }}</p> --}}
                
                            <!-- Display the timestamps -->
                            <p><strong>Created At:</strong> {{ $sousCategorie->created_at }}</p>
                            <p><strong>Updated At:</strong> {{ $sousCategorie->updated_at }}</p>
                        </div>
                    </div>
                
                    <a href="{{ route('sous-categorie.index') }}" class="btn btn-primary mt-3">Back to List</a>
                </div>
                

        </div>
    </div>

                        </div>
                    </div>
                </div>
</body>
</html>