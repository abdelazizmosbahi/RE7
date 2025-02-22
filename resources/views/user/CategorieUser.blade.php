<!-- Add Navigation Buttons to Other Pages -->
<div>
    <h1>User - categorie</h1>
    <a href="/welcome">Go to Welcome</a><br>
    <a href="/admin/categorie">Go to Admin - ajouter Categories</a><br>
    <a href="/admin/consulter-list-recette">Go to Admin - View Recipe List</a><br>
    <a href="/admin/consulter-recette">Go to Admin - View Recipe</a><br>
    <a href="/admin/modifier-recette">Go to Admin - Edit Recipe</a><br>
    <a href="/admin/souscategorie">Go to Admin - Subcategories</a><br>
    <a href="/user/ajouter-recette">Go to User - Add Recipe</a><br>
    <a href="/user/categorie">Go to User - Categories</a><br>
    <a href="/user/consulter-list-recette">Go to User - View Recipe List</a><br>
    <a href="/user/consulter-recette">Go to User - View Recipe</a><br>
    <a href="/user/mes-recettes">Go to User - My Recipes</a><br>
    <a href="/user/souscategorie">Go to User - Subcategories</a><br>
    </div>




    
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
                        <a href="#" class="nav-link">
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
                            <h4 class="mb-sm-0">Catégorie details</h4>
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
            
    </div>

                        </div>
                    </div>
                </div>
</body>
</html>