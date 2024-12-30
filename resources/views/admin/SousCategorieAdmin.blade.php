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
    <title>Admin - Manage Sous-Catégories</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS (make sure this is after jQuery) -->
<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
 
<body onload="fetchSousCategories()">
 
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
                            <h4 class="mb-sm-0">Sous-Catégorie</h4>
                        </div>
                    </div>
                </div>
 <!-- Sous Category List Section -->
<div id="all-categories-list" class="col-xl-8">
    <!-- List of Sous Categories will be displayed here -->
</div>

<!-- Update Modal for Sous-Catégorie -->
<div class="modal fade" id="updateSousCategorieModal" tabindex="-1" aria-labelledby="updateSousCategorieModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); margin: 0;">
        <div class="modal-content">
            <form id="update-sous-categorie-form">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="updateSousCategorieModalLabel">Modifier Sous-Catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="update-sous-categorie-id" name="id">
                    
                    <!-- Sous-Catégorie Title -->
                    <div class="mb-3">
                        <label for="update-sous-categorie-title" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="update-sous-categorie-title" name="titre" required>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="mb-3">
                        <label for="update-categorie_id" class="form-label">Catégorie</label>
                        <select id="update-categorie_id" name="categorie_id" class="form-control" required>
                            <option value="">Sélectionner une catégorie</option>
                        </select>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="update-sous-categorie-image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="update-sous-categorie-image" name="image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Mise à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); margin: 0;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Supprimer Sous-Catégorie</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Êtes-vous sûr de vouloir supprimer cette sous-catégorie ?
            <input type="hidden" id="delete-id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-danger" id="confirm-delete-btn">Supprimer</button>
        </div>
      </div>
    </div>
</div>


<!-- Sous Category Details Section -->
<div id="get-category-result" class="mt-4">
</div>
                <div class="col-xl-4">
                    <div class="sticky-side-div">
                        <div class="card">
                            <div class="card-header border-bottom-dashed">
                                <h5 class="card-title mb-0">Ajouter une Sous-Catégorie</h5>
                            </div>
                            <form id="add-sous-categorie-form" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body pt-2">
                                    <div><label for="titre" class="text-muted text-uppercase fw-semibold">Titre</label></div>
                                    <input type="text" id="titre" name="titre" class="form-control" placeholder="Entrer titre" required>
                                </div>

                                <!-- Category Dropdown -->
                                <div class="card-body pt-2">
                                    <div><label for="categorie_id" class="text-muted text-uppercase fw-semibold">Catégorie</label></div>
                                    <select id="categorie_id" name="categorie_id" class="form-control" required>
                                        <option value="">Sélectionner une catégorie</option>
                                    </select>
                                </div>
                                <div class="card-body pt-2">
                                    <div><label for="image" class="text-muted text-uppercase fw-semibold">Image de sous-catégorie</label></div>
                                    <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                                </div>

                                <button type="submit" class="btn btn-warning" style="float: right; margin-top: 10px;">Ajouter</button>
                            </form>
                            <br>
                            <div id="add-success-message" class="mt-3" style="display:none; color:green;">Sous-Catégorie ajoutée avec succès !</div>
                        </div>
                    </div>
                </div>
 
            </div>
        </div>
    </div>
 
    <script>
 // Handle Add Sous-Catégorie form submission
 $('#add-sous-categorie-form').submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this); // Form data including image and category

    $.ajax({
        url: '/admin/add-sous-categorie',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#add-success-message').show();
            $('#add-sous-categorie-form')[0].reset(); // Reset the form
            fetchSousCategories(); // Reload the sous-categories list after adding
        },
        error: function (xhr, status, error) {
            alert("Error: " + xhr.responseText);
        }
    });
});

          // Load categories and sous-categories when the page loads
          window.addEventListener('DOMContentLoaded', () => {
            loadCategories();
            loadSousCategories();
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


// Fetch Sous-Categories and display them with a click event to show details
function fetchSousCategories() {
    fetch('/admin/get-all-sous-categories')
        .then(response => response.json())
        .then(sousCategories => {
            const listDiv = document.getElementById('all-categories-list');
            listDiv.innerHTML = ''; // Clear the previous list

            if (sousCategories.length > 0) {
                const list = document.createElement('ul');
                list.className = 'list-group';

                sousCategories.forEach(sousCategorie => {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item d-flex justify-content-start align-items-center';

                    // Flex container for image and titles (sous-categorie title + category title)
                    const titleDiv = document.createElement('div');
                    titleDiv.className = 'd-flex flex-column ms-3'; // Use flex column to stack titles vertically

                    // Image of the sous-categorie
                    const image = document.createElement('img');
                    image.src = `{{ asset('storage/') }}/${sousCategorie.image}`; // Image URL for sous-categorie
                    image.alt = sousCategorie.titre;
                    image.style.width = '100px';
                    image.style.height = '100px';

                    // Title of the sous-categorie
                    const title = document.createElement('span');
                    title.textContent = sousCategorie.titre; // Title of sous-categorie
                    title.style.cursor = 'pointer';
                    title.classList.add('mt-2'); // Add margin to the top of sous-categorie title
                    title.addEventListener('click', () => {
                    // Redirect to the sous-categorie details page with the correct URL format
                    window.location.href = `/admin/souscategorie/${sousCategorie.id}`;
                });


                    // Category title below the sous-categorie title
                    const categoryTitle = document.createElement('span');
                    categoryTitle.className = 'text-muted mt-2'; // Add margin to the top of category title
                    categoryTitle.textContent = '' + sousCategorie.categorie_title; // Assuming the related category title is available as `categorie_title`

                    // Append image and titles to the titleDiv
                    titleDiv.appendChild(title);
                    titleDiv.appendChild(categoryTitle); // Add category title below sous-categorie title

                    // Add spacing between titles and buttons
                    const spacingDiv = document.createElement('div');
                    spacingDiv.style.marginLeft= '240px';  // You can adjust this value (20px) to whatever you need

                    // Append image, titleDiv, and spacingDiv to the list item
                    listItem.appendChild(image);
                    listItem.appendChild(titleDiv);
                    listItem.appendChild(spacingDiv);

                    // Add delete button
                    const deleteButton = document.createElement('button');
                    deleteButton.className = 'btn btn-danger btn-sm';
                    deleteButton.textContent = 'Supprimer';
                    deleteButton.addEventListener('click', () => showDeleteModal(sousCategorie.id));
                    listItem.appendChild(deleteButton);

                    // Add update button
                    const updateButton = document.createElement('button');
                    updateButton.className = 'btn btn-warning btn-sm ms-2'; // Add margin to the left of the update button
                    updateButton.textContent = 'Modifier';
                    updateButton.addEventListener('click', () => showUpdateSousCategorieModal(sousCategorie)); // Use the correct function here
                    listItem.appendChild(updateButton);

                    // Append the list item to the list
                    list.appendChild(listItem);
                });

                // Append the list to the main container
                listDiv.appendChild(list);
            } else {
                listDiv.innerHTML = '<p>No sous categories found.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching sous categories:', error);
            document.getElementById('all-categories-list').innerHTML = '<p class="text-danger">Failed to load sous categories.</p>';
        });
}




// Handle Update Modal
function showUpdateSousCategorieModal(sousCategorie) {
    // Set the modal fields with the sous-categorie data
    $('#update-sous-categorie-id').val(sousCategorie.id); // Set the ID for hidden field
    $('#update-sous-categorie-title').val(sousCategorie.titre); // Set the title for input field

    // Set the selected category in the category dropdown
    $('#update-categorie_id').val(sousCategorie.categorie_id); // Set the associated category

    // Show the modal
    $('#updateSousCategorieModal').modal('show');
}

// Load Categories into the Dropdown
function loadCategoriesForUpdate() {
    fetch('/admin/get-all-categories')
        .then(response => response.json())
        .then(data => {
            const categorySelect = document.getElementById('update-categorie_id');
            categorySelect.innerHTML = '<option value="">Sélectionner une catégorie</option>'; // Reset the dropdown

            data.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.titre;
                categorySelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error loading categories for update:', error));
}

// Handle Update Form Submission for Sous-Catégorie
$('#update-sous-categorie-form').submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        url: '/admin/update-sous-categorie',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            alert('Sous-Catégorie updated successfully!');
            location.reload(); // Reload the entire page to reflect the changes
            $('#updateModal').modal('hide'); // Hide the update modal
        },
        error: function (xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});


// Load Categories when the page loads
window.addEventListener('DOMContentLoaded', () => {
    loadCategoriesForUpdate();
    loadSousCategories(); // Load the list of sous-categories
});



// Show Delete Modal for Sous-Catégorie
function showDeleteModal(sousCategorieId) {
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    document.getElementById('confirm-delete-btn').onclick = function () {
        deleteSousCategorie(sousCategorieId);
        deleteModal.hide();
    };
    deleteModal.show();
}

// Delete Sous-Catégorie
function deleteSousCategorie(sousCategorieId) {
    fetch('/admin/delete-sous-categorie', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ id: sousCategorieId }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Sous-Catégorie deleted successfully') {
            alert(data.message);
            document.getElementById('get-all-sous-categories-btn').click(); // Refresh the list of Sous-Catégories
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error deleting Sous-Catégorie:', error);
        alert('An error occurred while deleting the Sous-Catégorie.');
    });
}

// Handle Delete Modal for Sous-Catégorie
function showDeleteModal(sousCategorieId) {
    // Set the Sous-Catégorie ID to delete
    $('#delete-id').val(sousCategorieId);
    // Show the modal
    $('#deleteModal').modal('show');
}

// Handle Delete Confirmation for Sous-Catégorie
$('#confirm-delete-btn').click(function () {
    let sousCategorieId = $('#delete-id').val();

    $.ajax({
        url: '/admin/delete-sous-categorie',
        method: 'POST',
        data: {
            _method: 'DELETE', // Specify the method as DELETE
            _token: $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
            id: sousCategorieId
        },
        success: function (response) {
            alert('Sous-Catégorie deleted successfully!');
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
