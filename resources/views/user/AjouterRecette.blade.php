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
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Ajouter une Recette</h4>
                        </div>
                    </div>
                </div>

                <!-- Form for adding a recipe -->
                <form id="addRecetteForm" action="{{ route('recette.add') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="categorie_id">Catégorie</label>
                        <select id="categorie_id" class="form-control" name="categorie_id" required>
                            <option value="">Sélectionner une catégorie</option>
                            <!-- Categories will be dynamically loaded here -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sous_categorie_id">Sous-Catégorie</label>
                        <select id="sous_categorie_id" class="form-control" name="sous_categorie_id" disabled required>
                            <option value="">Sélectionner une sous-catégorie</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" class="form-control" name="titre" required>
                    </div>

                    <div class="form-group">
                        <label for="ingredients">Ingrédients</label>
                        <input id="ingredients" class="form-control" name="ingredients" required></input>
                    </div>

                    <div class="form-group">
                        <label for="methode_preparation">Méthode de préparation</label>
                        <input id="methode_preparation" class="form-control" name="methode_preparation" required></input>
                    </div>

                    <div class="mb-3">
                        <label for="update-image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="update-image" name="image" accept="image/*">
                      </div>

                    <div class="form-group">
                        <label for="informations_complementaire">Informations complémentaires</label>
                        <input id="informations_complementaire" class="form-control" name="informations_complementaire"></input>
                    </div>
<br>
                    <button type="submit" class="btn btn-primary">Ajouter la Recette</button>
                </form>
                <br><div id="add-success-message" class="mt-3" style="display:none; color:green;">
                    Recette added successfully!
                </div>
                

            </div>
        </div>
    </div>

                
  

                
</body>
<script>
    document.getElementById('addRecetteForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('{{ route("recette.add") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            // If the response isn't OK, throw an error
            throw new Error('Network response was not OK');
        }
        // Try to parse JSON
        return response.json();
    })
    .then(data => {
        // Show the success message
        const successMessage = document.getElementById('add-success-message');
        successMessage.style.display = 'block';
    //     document.getElementById('addRecetteForm').reset();
    // })
    // Wait a moment to let the user see the success message
    setTimeout(() => {
            location.reload(); // Refresh the page
        }, 2000); // Adjust delay (2 seconds here) as needed
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while adding the recette. Please try again.');
    });
});


    // Load categories and sous-categories when the page loads
    window.addEventListener('DOMContentLoaded', () => {
        loadCategories();
    });

    // Function to load categories dynamically into the dropdown
    function loadCategories() {
        fetch('/admin/get-all-categories')
            .then(response => response.json())
            .then(data => {
                const categorySelect = document.getElementById('categorie_id');
                data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.titre;
                    categorySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erreur lors du chargement des catégories:', error));
    }

    // Function to load sous-categories dynamically based on selected category
    function loadSousCategories(categoryId) {
        const sousCategorieSelect = document.getElementById('sous_categorie_id');
        sousCategorieSelect.innerHTML = '';  // Clear previous options
        sousCategorieSelect.disabled = true;  // Disable the dropdown initially

        if (categoryId === "") {
            return;  // No category selected, don't fetch sous-categories
        }

        fetch(`/user/get-sous-categories-by-category/${categoryId}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    sousCategorieSelect.disabled = false;  // Enable the dropdown
                    data.forEach(sousCategorie => {
                        const option = document.createElement('option');
                        option.value = sousCategorie.id;
                        option.textContent = sousCategorie.titre;
                        sousCategorieSelect.appendChild(option);
                    });
                } else {
                    // No sous-categories, leave it empty and disabled
                    sousCategorieSelect.disabled = true;  // Ensure the dropdown is disabled
                }
            })
            .catch(error => console.error('Erreur lors du chargement des sous-catégories:', error));
    }

    // Event listener to update sous-categories when a category is selected
    document.getElementById('categorie_id').addEventListener('change', (e) => {
        loadSousCategories(e.target.value);
    });


    

    
</script>

</html>