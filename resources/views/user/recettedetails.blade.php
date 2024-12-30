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
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">



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
                            <span data-key="t-dashboards">Dashboards</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span data-key="t-dashboards">Gérer Recette</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" style=" color: orange;">
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
                            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                <h2 style="margin: 0;">{{ $recette->titre }}</h2>
                                <!-- Average Rating as Stars -->
                                @php
                                    // Filter the rates by status 'approved'
                                    $approvedRates = $recette->rates->where('status', 'approved');
                                    // Calculate the average rating only from approved rates
                                    $averageRating = $approvedRates->avg('stars');
                                    $averageRatingRounded = round($averageRating); // Rounded to nearest integer
                                @endphp
                                <span style="margin: 0;">
                                    @if($averageRating)  <!-- Display stars if there's any approved rating -->
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $averageRatingRounded)
                                                <i class="fa fa-star" style="color: gold;"></i> <!-- Filled star -->
                                            @else
                                                <i class="fa fa-star-o" style="color: gold;"></i> <!-- Empty star -->
                                            @endif
                                        @endfor
                                    @else
                                        <span>(Aucune note pour l'instant)</span>
                                    @endif
                                </span>
                            </div>
                            <div class="card-body">
                                <img src="{{ asset('storage/' . $recette->image) }}" alt="{{ $recette->titre }}" width="200">
<p></p>
                                <p><strong>Ingrédients:</strong></p>
                                <p>{{ $recette->ingredients }}</p>
                                <p><strong>Methode de préparation:</strong></p>
                                <p>{{ $recette->methode_preparation }}</p>
            
                                <p><strong>Informations complémentaires:</strong></p>
                                <p>{{ $recette->informations_complementaire }}</p>
            
                                {{-- <p><strong>Created At:</strong> {{ $recette->created_at }}</p>
                                <p><strong>Updated At:</strong> {{ $recette->updated_at }}</p> --}}
                            </div>
                            <div class="card-footer">
                                <a href="/userhome" class="btn btn-primary">Retour à la liste</a>
                            </div>
                        </div>
                    </div>
            
                    <!-- Rating Form Section (Right side) -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Évaluez cette recette</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('rate.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="recette_id" value="{{ $recette->id }}">
            
                                    <!-- Stars Input -->
                                    <div class="mb-3">
                                        <label class="form-label">Votre note :</label>
                                        <div class="rating" style="font-size: 1.5rem;">
                                            @for($i = 1; $i <= 5; $i++)
                                                <input type="radio" id="star{{ $i }}" name="stars" value="{{ $i }}" style="display: none;" required>
                                                <label for="star{{ $i }}" style="cursor: pointer;">
                                                    <i class="fa fa-star-o star-icon" data-value="{{ $i }}" style="color: gold;"></i>
                                                </label>
                                            @endfor
                                        </div>
                                    </div>
            
                                    <!-- Comment -->
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Commentaire (facultatif) :</label>
                                        <textarea id="comment" name="comment" class="form-control" rows="4"></textarea>
                                    </div>
            
                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-success">Soumettre</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Display the Comments in a Message Box Style -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Commentaires</h4>
                            </div>
                            <div class="card-body">
                                @if($approvedRates->isEmpty() || $approvedRates->every(fn($rate) => is_null($rate->comment) || $rate->comment === ''))
                                    <p>Pas encore de commentaires pour cette recette.</p>
                                @else
                                    @foreach($approvedRates as $rate)
                                        @if($rate->comment)  <!-- Display the comment if not null -->
                                            <div class="alert alert-info mb-3">
                                                <!-- User Icon -->
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-user-circle fa-2x mr-2"></i>
                                                    <div>
                                                        <p><strong>Commentaire:</strong> {{ $rate->comment }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            
                <script>
                    // Select all the star icons
                    const stars = document.querySelectorAll('.star-icon');
                    const inputs = document.querySelectorAll('input[name="stars"]');
                
                    // Add click event to each star
                    stars.forEach(star => {
                        star.addEventListener('click', function () {
                            const rating = this.getAttribute('data-value');
                
                            // Set all stars up to the clicked star as active (filled)
                            stars.forEach(s => {
                                const starValue = s.getAttribute('data-value');
                                if (starValue <= rating) {
                                    s.classList.remove('fa-star-o');
                                    s.classList.add('fa-star');
                                } else {
                                    s.classList.remove('fa-star');
                                    s.classList.add('fa-star-o');
                                }
                            });
                
                            // Set the corresponding radio button as checked
                            inputs.forEach(input => {
                                if (input.value === rating) {
                                    input.checked = true;
                                }
                            });
                        });
                    });
                
                    // Refresh the page after a successful rating submission
                    @if(session('rating_submitted'))
                        window.location.reload();
                    @endif
                </script>
                
            



</body>
</html>