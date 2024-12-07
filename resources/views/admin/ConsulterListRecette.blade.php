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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap CSS (Bootstrap 5) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (Bootstrap 5) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
                            <h4 class="mb-sm-0">Recette liste</h4>
                        </div>
                    </div>
                </div>
               

 
 
                <div class="container">
                    <h2 class="my-4">Manage Recettes</h2>
            
                    <!-- Add Recipe Form -->
                    <h3>Add a New Recette</h3>
                    <form action="/recettes" method="POST" enctype="multipart/form-data">
                        <!-- Replace with appropriate CSRF token for security -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
                        <div class="form-group">
                            <label for="titre">Title</label>
                            <input type="text" name="titre" id="titre" class="form-control" required>
                        </div>
            
                        <div class="form-group">
                            <label for="image">Image (optional)</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
            
                        <div class="form-group">
                            <label for="categorie_id">Category</label>
                            <select name="categorie_id" id="categorie_id" class="form-control" required>
                                <!-- Categories will be dynamically loaded here -->
                            </select>
                        </div>
            
                        <div class="form-group">
                            <label for="sous_categorie_id">Sous-Category</label>
                            <select name="sous_categorie_id" id="sous_categorie_id" class="form-control" required>
                                <!-- Sous-categories will be dynamically loaded here -->
                            </select>
                        </div>
            
                        <div class="form-group">
                            <label for="ingredients">Ingredients</label>
                            <textarea name="ingredients" id="ingredients" class="form-control" rows="4" required></textarea>
                        </div>
            
                        <div class="form-group">
                            <label for="methode_preparation">Preparation Method</label>
                            <textarea name="methode_preparation" id="methode_preparation" class="form-control" rows="4" required></textarea>
                        </div>
            
                        <div class="form-group">
                            <label for="informations_complementaire">Additional Information (optional)</label>
                            <textarea name="informations_complementaire" id="informations_complementaire" class="form-control" rows="4"></textarea>
                        </div>
            <br>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="acceptée">Accepted</option>
                                <option value="en cours">In Progress</option>
                                <option value="refusée">Rejected</option>
                            </select>
                        </div>
            
                        <button type="submit" class="btn btn-primary">Add Recette</button>
                    </form>
            
                    <hr>
            
                    <!-- Display all recipes -->
                    <h3>All Recettes</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Sous-Category</th>
                                <th>Ingredients</th>
                                <th>Preparation Method</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through recettes -->
                            <tr>
                                <td>Recipe 1</td>
                                <td>Category 1</td>
                                <td>Sous-Category 1</td>
                                <td>Ingredients for recipe 1</td>
                                <td>Method for recipe 1</td>
                                <td>Accepted</td>
                                <td>
                                    <a href="/recettes/1/edit" class="btn btn-warning">Edit</a>
                                    <form action="/recettes/1" method="POST" style="display:inline;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Repeat for other recipes -->
                        </tbody>
                    </table>
                </div>
 
 
    <script>
        // Function to load categories dynamically
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
    // Check if categoryId is valid
    if (!categoryId) {
        console.error("Invalid category ID:", categoryId);
        return;
    }

    // Fetch sous-categories based on selected category ID
    fetch(`/admin/get-all-sous-categories/${categoryId}`)
        .then(response => response.json())
        .then(data => {
            // Get the sous-categorie dropdown
            const sousCategorieSelect = document.getElementById('sous_categorie_id');
            sousCategorieSelect.innerHTML = ''; // Clear previous options

            if (data.length === 0) {
                // If no sous-categories are found, you can show a message or disable the dropdown
                const option = document.createElement('option');
                option.textContent = "No sous-categories available";
                sousCategorieSelect.appendChild(option);
            } else {
                // Populate the sous-categorie dropdown with the fetched data
                data.forEach(sousCategory => {
                    const option = document.createElement('option');
                    option.value = sousCategory.id;
                    option.textContent = sousCategory.titre;
                    sousCategorieSelect.appendChild(option);
                });
            }
        })
        .catch(error => console.error('Error loading sous-categories:', error));
}

// Event listener for category change to load corresponding sous-categories
document.getElementById('categorie_id').addEventListener('change', function () {
    const categoryId = this.value;
    if (categoryId) {
        loadSousCategories(categoryId); // Load sous-categories when category changes
    } else {
        document.getElementById('sous_categorie_id').innerHTML = ''; // Clear sous-categories if no category selected
    }
});


        // Load categories when the page is ready
        window.onload = loadCategories;
    </script>
</body>
 
</html>
 