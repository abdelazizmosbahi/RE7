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
                            <h4 class="mb-sm-0">Catégorie</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div id="all-categories-list" class="mt-3"></div>
                <!--  récupérer tous les catégories -->
                <script>
                // Lors du chargement de la page, récupérer les catégories depuis l'API
                window.addEventListener('DOMContentLoaded', (event) => {
                    fetch('/admin/get-all-categories') // Route API pour récupérer toutes les catégories
                        .then(response => response.json())
                        .then(data => {
                            const categoriesList = document.getElementById('all-categories-list');
                            categoriesList.innerHTML = ''; // Effacer tout contenu précédent
 
                            // Pour chaque catégorie, créer une carte avec son nom, son image et les boutons
                            data.forEach(category => {
                                const categoryCard = `
                        <div class="col-xl-8">
                            <div class="card product">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h5 class="fs-15 text">
                                                <a class="text-dark">
                                                    ${category.name} <!-- Nom de la catégorie -->
                                                </a>
                                            </h5>
                                            <div class="avatar-lg bg-light rounded p-1">
                                                <img src="${category.image}" alt="${category.name}" class="img-fluid d-block" /> <!-- Image de la catégorie -->
                                            </div>
                                        </div>
                                        <div>
                                            <!-- Boutons Modifier et Supprimer -->
                                            <button
                                                type="button"
                                                class="btn btn-outline-dark"
                                                style="margin-right: 8px;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#showModal">
                                                Modifier
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteOrder">
                                                Supprimer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                                categoriesList.innerHTML +=
                                categoryCard; // Ajouter la carte à la liste des catégories
                            });
                        })
                        .catch(error => console.error('Erreur lors de la récupération des catégories:', error));
                });
                </script>
                 <div class="col-xl-4">
                    <div class="sticky-side-div">
                        <div class="card">
                            <div class="card-header border-bottom-dashed">
                                <h5 class="card-title mb-0">Ajouter catégorie</h5>
                            </div>
                            <form id="add-categorie-form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="titre">Titre</label>
                                    <input type="text" id="titre" name="titre" class="form-control" placeholder="Entrer titre" required>
                                </div>
                            <div class="card-body pt-2">
                                <div>
                                    <label for="imageRecette" class="text-muted text-uppercase fw-semibold">
                                        Image de catégorie
                                    </label>
                                </div>
                                <div class="dropzone">
                                    <div class="fallback">
                                    <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                                    </div>
                                    <div style="text-align: center;">
                                        <i class="display-6 text-muted ri-upload-cloud-2-fill"></i>
                                        <h6>Entrer l'image de la catégorie</h6>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-warning" style="float: right; margin-top: 10px;">Ajouter</button>
                            </form><br>
                                <div id="add-success-message" class="mt-3" style="display:none; color:green;">Category added successfully!</div>
                            </div>
                        </div>
                    </div>
                </div>
                                  <script>

                        // Handle Add Categorie
$('#add-categorie-form').submit(function(e) {
    e.preventDefault();
    // Create FormData to handle file uploads
    let formData = new FormData(this);

    $.ajax({
        url: '/admin/add-categorie',
        method: 'POST',
        data: formData,
        processData: false, // Required for FormData
        contentType: false, // Required for FormData
        success: function(response) {
            $('#add-success-message').show();
            $('#add-categorie-form')[0].reset();
        },
        error: function(xhr, status, error) {
            alert("Error: " + xhr.responseText);
        }
    });
});
 
                // Charger les catégories
                function loadCategories() {
                    fetch('/admin/get-all-categories')
                        .then(response => response.json())
                        .then(data => {
                            const categoriesList = document.getElementById('all-categories-list');
                            categoriesList.innerHTML = ''; // Effacer les anciennes catégories
 
                            data.forEach(category => {
                                const categoryCard = `
            <div class="col-xl-8">
              <div class="card product">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h5 class="fs-15 text">
                        <a  class="text-dark">
                          ${category.titre}
                        </a>
                      </h5>
                      <div class="avatar-lg bg-light rounded p-1">
                        <img src="${category.image}" alt="${category.titre}" class="img-fluid d-block" />
                      </div>
                    </div>
                    <div>
                      <button type="button" class="btn btn-outline-dark" style="margin-right: 8px;" data-bs-toggle="modal" data-bs-target="#showModal">Modifier</button>
                      <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteOrder">Supprimer</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          `;
                                categoriesList.innerHTML += categoryCard;
                            });
                        })
                        .catch(error => console.error('Erreur lors de la récupération des catégories:', error));
                }
 
                // Charger les catégories lors du chargement de la page
                window.addEventListener('DOMContentLoaded', () => {
                    loadCategories();
                });

// Show Delete Modal
function showDeleteModal(categoryId) {
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    document.getElementById('confirm-delete-btn').onclick = function () {
        deleteCategory(categoryId);
        deleteModal.hide();
    };
    deleteModal.show();
}
// Delete Category
function deleteCategory(categoryId) {
    fetch('/admin/delete-categorie', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ id: categoryId }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Category deleted successfully') {
                alert(data.message);
                document.getElementById('get-all-categories-btn').click(); // Refresh the list
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error deleting category:', error);
            alert('An error occurred while deleting the category.');
        });
}
// Handle Update Modal
function showUpdateModal(category) {
    // Set the modal fields with the category data
    $('#update-id').val(category.id);
    $('#update-title').val(category.titre);
    // Show the modal
    $('#updateModal').modal('show');
}

// Handle Delete Modal
function showDeleteModal(categoryId) {
    // Set the category ID to delete
    $('#delete-id').val(categoryId);
    // Show the modal
    $('#deleteModal').modal('show');
}
// Handle Update Form Submission
$('#update-category-form').submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        url: '/admin/update-categorie',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            alert('Category updated successfully!');
            location.reload(); // Reload the page to reflect changes
        },
        error: function (xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});
                </script>
</body>
 
</html>