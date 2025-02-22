<!-- Add Navigation Buttons to Other Pages -->
<div>
    <h1> admin -modifier recette admin </h1>
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



<hr>
<form action="{{ url('/admin/update-categorie/' . $categorie->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Use PUT method for updates -->
    <div>
        <label for="titre">Title</label>
        <input type="text" name="titre" id="titre" value="{{ $categorie->titre }}" required>
    </div>
    <div>
        <label for="image">Image</label>
        <input type="text" name="image" id="image" value="{{ $categorie->image }}" required>
    </div>
    <button type="submit">Update Category</button>
</form>





<!-- Add Navigation Buttons to Other Pages -->
<div>
    <h1> admin - consulter list recette </h1>
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Admin - Manage Categories</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Manage Categories</h1>

        <!-- Add Categorie -->
        <div class="card mb-4">
            <div class="card-header">Add Categorie</div>
            <div class="card-body">
                <form id="add-categorie-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" class="form-control" placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Add</button>
                </form>
                <div id="add-success-message" class="mt-3" style="display:none; color:green;">Category added successfully!</div>
            </div>
        </div>        

<!-- Get All Categories -->
<div class="mb-4">
    <button id="get-all-categories-btn" class="btn btn-info">Get All Categories</button>
    <div id="all-categories-list" class="mt-3"></div>
</div>
<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="update-category-form">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="updateModalLabel">Update Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="update-id" name="id">
            <div class="mb-3">
              <label for="update-title" class="form-label">Title</label>
              <input type="text" class="form-control" id="update-title" name="titre" required>
            </div>
            <div class="mb-3">
              <label for="update-image" class="form-label">Image</label>
              <input type="file" class="form-control" id="update-image" name="image" accept="image/*">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <!-- Delete Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this category?
          <input type="hidden" id="delete-id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirm-delete-btn">Delete</button>
        </div>
      </div>
    </div>
  </div>
  
<!-- Category Details Section -->
<div id="get-category-result" class="mt-4">
    <!-- Detailed information about a clicked category will be displayed here -->
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



        document.getElementById('get-all-categories-btn').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent the page from refreshing
    fetch('/admin/get-all-categories')
        .then(response => response.json())
        .then(categories => {
            const listDiv = document.getElementById('all-categories-list');
            listDiv.innerHTML = ''; // Clear the previous list

            if (categories.length > 0) {
                const list = document.createElement('ul');
                list.className = 'list-group';

                categories.forEach(category => {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item d-flex justify-content-between align-items-center';

                    // Add category title as clickable
                    const title = document.createElement('span');
                    title.textContent = category.titre;
                    title.style.cursor = 'pointer';
                    title.addEventListener('click', () => displayCategoryDetails(category));
                    listItem.appendChild(title);

                    // Add delete button
                    const deleteButton = document.createElement('button');
                    deleteButton.className = 'btn btn-danger btn-sm';
                    deleteButton.textContent = 'Delete';
                    deleteButton.addEventListener('click', () => showDeleteModal(category.id));
                    listItem.appendChild(deleteButton);

                    // Add update button
                    const updateButton = document.createElement('button');
                    updateButton.className = 'btn btn-warning btn-sm';
                    updateButton.textContent = 'Update';
                    updateButton.addEventListener('click', () => showUpdateModal(category));
                    listItem.appendChild(updateButton);

                    list.appendChild(listItem);
                });

                listDiv.appendChild(list);
            } else {
                listDiv.innerHTML = '<p>No categories found.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching categories:', error);
            document.getElementById('all-categories-list').innerHTML = '<p class="text-danger">Failed to load categories.</p>';
        });
});

// Display category details
function displayCategoryDetails(category) {
    const detailsDiv = document.getElementById('get-category-result');
    const imageUrl = `{{ asset('storage/') }}/${category.image}`;
    detailsDiv.innerHTML = `
        <p><strong>Title:</strong> ${category.titre}</p>
        <p><strong>Image:</strong><br><img src="${imageUrl}" alt="${category.titre}" style="max-width: 150px;"></p>
    `;
}

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

// Handle Delete Confirmation
$('#confirm-delete-btn').click(function () {
    let categoryId = $('#delete-id').val();

    $.ajax({
        url: '/admin/delete-categorie',
        method: 'POST',
        data: {
            _method: 'DELETE', // Specify the method as DELETE
            _token: $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
            id: categoryId
        },
        success: function (response) {
            alert('Category deleted successfully!');
            location.reload(); // Reload the page to reflect changes
        },
        error: function (xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});

        // Handle Get Categorie
    $('#get-categorie-form').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url: '/admin/get-categorie-by-id',  // Assuming this is the correct route
            method: 'GET',
            data: formData,
            success: function(response) {
                // Check if the response is successful
                let category = response;
                let imageUrl = "{{ asset('storage/') }}/" + category.image; // Build the image URL

                // Display the category title and image
                $('#get-category-result').html(`
                    <p>Category: ${category.titre}</p>
                    <p><img src="${imageUrl}" alt="Category Image" width="100" height="100"></p>
                `);
            },
            error: function(xhr, status, error) {
                alert("Error: " + xhr.responseText);
            }
        });
    });
    </script>
</body>
</html>






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
                <div id="all-categories-list" class="row mb-3"></div>
                <!--  récupérer tous les catégories -->
<script>
                // Lors du chargement de la page, récupérer les catégories depuis l'API
                window.addEventListener('DOMContentLoaded', () => {
       fetch('/admin/get-all-categories')
           .then(response => response.json())
           .then(data => {
               const categoriesList = document.getElementById('all-categories-list');
               categoriesList.innerHTML = '';
               data.forEach(category => {
                   const categoryName = category.name || "Nom non disponible";
                   const categoryImage = category.image || "/assets/images/default-category.jpg";
                   const categoryCard = `
                       <div class="card product mb-3">
                           <div class="card-body">
                               <div class="d-flex align-items-center justify-content-between">
                                   <div>
                                       <h5 class="fs-15 text">
                                           <a class="text-dark">${categoryName}</a>
                                       </h5>
                                       <div class="avatar-lg bg-light rounded p-1">
                                           <img src="${categoryImage}" alt="${categoryName}" class="img-fluid d-block" />
                                       </div>
                                   </div>
                                   <div>
                                       <button type="button" class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#showModal">Modifier</button>
                                       <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteOrder">Supprimer</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                   `;
                   categoriesList.innerHTML += categoryCard;
               });
           })
           .catch(error => console.error('Erreur lors de la récupération des catégories:', error));
   });
 
</script>
 
 
                <div class="col-xl-4">
                    <div class="sticky-side-div">
                        <div class="card">
                            <div class="card-header border-bottom-dashed">
                                <h5 class="card-title mb-0">Ajouter une catégorie</h5>
                            </div>
                            <form id="add-categorie-form" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body pt-2">
 
                                    <div><label for="titre" class="text-muted text-uppercase fw-semibold">Titre</label>
                                    </div>
                                    <input type="text" id="titre" name="titre" class="form-control"
                                        placeholder="Entrer titre" required>
                                </div>
                                <div class="card-body pt-2">
                                    <div> <label for="imageRecette" class="text-muted text-uppercase fw-semibold">
                                            Image
                                            de catégorie </label> </div>
                                    <div class="dropzone">
                                        <div class="fallback"> <input type="file" id="image" name="image"
                                                class="form-control" accept="image/*" required> </div>
                                        <div style="text-align: center;"> <i
                                                class="display-6 text-muted ri-upload-cloud-2-fill"></i>
                                            <h6>Entrer l'image de la catégorie</h6>
                                        </div>
                                    </div> <button type="submit" class="btn btn-warning"
                                        style="float: right; margin-top: 10px;">Ajouter</button>
                            </form><br>
                            <div id="add-success-message" class="mt-3" style="display:none; color:green;">Catégorie
                                ajoutée avec succès !</div>
                        </div>
                    </div>
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
        document.getElementById('confirm-delete-btn').onclick = function() {
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
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content'),
                },
                body: JSON.stringify({
                    id: categoryId
                }),
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
    $('#update-category-form').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
 
        $.ajax({
            url: '/admin/update-categorie',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Category updated successfully!');
                location.reload(); // Reload the page to reflect changes
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    });
    </script>
</body>
 
</html>
 




{{-- old code  --}}


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
<!-- Liste des catégories -->
<div id="all-categories-list" class="col-xl-8"></div>
<div id="category-details"></div>
                                    

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); margin: 0;">
      <div class="modal-content">
        <form id="update-category-form">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="updateModalLabel">Update Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="update-id" name="id">
            <div class="mb-3">
              <label for="update-title" class="form-label">Title</label>
              <input type="text" class="form-control" id="update-title" name="titre" required>
            </div>
            <div class="mb-3">
              <label for="update-image" class="form-label">Image</label>
              <input type="file" class="form-control" id="update-image" name="image" accept="image/*">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
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
          <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this category?
          <input type="hidden" id="delete-id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirm-delete-btn">Delete</button>
        </div>
      </div>
    </div>
  </div>
  
  
<!-- Category Details Section -->
<div id="get-category-result" class="mt-4">
    <!-- Detailed information about a clicked category will be displayed here -->
</div>
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
            document.addEventListener('DOMContentLoaded', function () {
    fetchCategories(); // Fetch categories on page load
});
function fetchCategories() {
    fetch('/admin/get-all-categories')
        .then(response => response.json())
        .then(categories => {
            const listDiv = document.getElementById('all-categories-list');
            listDiv.innerHTML = ''; // Clear the previous list

            if (categories.length > 0) {
                const list = document.createElement('ul');
                list.className = 'list-group';

                categories.forEach(category => {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item d-flex justify-content-between align-items-center';

                    // Add category title and image as clickable
                    const titleDiv = document.createElement('div');
                    titleDiv.className = 'd-flex align-items-center';

                    const title = document.createElement('span');
                    title.textContent = category.titre;
                    title.style.cursor = 'pointer';
                    title.addEventListener('click', () => displayCategoryDetails(category, listItem));

                    const image = document.createElement('img');
                    image.src = `{{ asset('storage/') }}/${category.image}`;
                    image.alt = category.titre;
                    image.style.width = '180px';
                    image.style.height = '100px';
                    image.classList.add('ms-2');
                    
                    titleDiv.appendChild(image);
                    titleDiv.appendChild(title);
                    listItem.appendChild(titleDiv);

                    // Add delete button
                    const deleteButton = document.createElement('button');
                    deleteButton.className = 'btn btn-danger btn-sm';
                    deleteButton.textContent = 'Delete';
                    deleteButton.addEventListener('click', () => showDeleteModal(category.id));
                    listItem.appendChild(deleteButton);

                    // Add update button
                    const updateButton = document.createElement('button');
                    updateButton.className = 'btn btn-warning btn-sm';
                    updateButton.textContent = 'Update';
                    updateButton.addEventListener('click', () => showUpdateModal(category));
                    listItem.appendChild(updateButton);

                    list.appendChild(listItem);
                });

                listDiv.appendChild(list);
            } else {
                listDiv.innerHTML = '<p>No categories found.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching categories:', error);
            document.getElementById('all-categories-list').innerHTML = '<p class="text-danger">Failed to load categories.</p>';
        });
}
function displayCategoryDetails(category) {
    const detailsContainer = document.getElementById('get-category-result');

    // Check if the details are already displayed for this category
    if (detailsContainer.dataset.categoryId === category.id.toString()) {
        // If details are already visible for this category, hide them
        detailsContainer.innerHTML = '';
        detailsContainer.removeAttribute('data-category-id'); // Clear the stored category ID
    } else {
        // Clear any existing details before adding new details
        detailsContainer.innerHTML = '';

        // Build the category details (image, title, subcategories)
        const imageUrl = `{{ asset('storage/') }}/${category.image}`;
        let detailsHtml = `
            <div class="category-details mt-3">
                <p><strong>Title:</strong> ${category.titre}</p>
                <p><strong>Image:</strong><br><img src="${imageUrl}" alt="${category.titre}" style="max-width: 150px;"></p>
        `;

        // Check if there are subcategories to display
        if (category.sousCategories && category.sousCategories.length > 0) {
            detailsHtml += '<h5>Subcategories:</h5><ul>';
            
            category.sousCategories.forEach(function(sousCategorie) {
                detailsHtml += `<li>${sousCategorie.titre}</li>`;
            });

            detailsHtml += '</ul>';
        } else {
            detailsHtml += '<p>No subcategories found.</p>';
        }

        detailsHtml += '</div>';

        // Insert the details HTML into the container
        detailsContainer.innerHTML = detailsHtml;
        detailsContainer.setAttribute('data-category-id', category.id);  // Store the category ID to track which category’s details are shown
    }
}
// Add click event listener to the categories
$(document).on('click', '.category-button', function() {
    var categoryId = $(this).closest('.category-item').data('id'); // Get the category ID from the clicked item

    // Fetch details from the server when a category is clicked
    $.ajax({
        url: '/path/to/your/getSousCategoriesByCategoryId', // Replace with your actual route
        type: 'GET',
        data: { category_id: categoryId },
        success: function(response) {
            if (response.category) {
                // Call the function to display the category details
                displayCategoryDetails(response.category);
            } else {
                alert('Category not found.');
            }
        },
        error: function() {
            alert('Error fetching category details.');
        }
    });
});
// Add click event listener to the categories
$(document).on('click', '.category-button', function() {
    var categoryId = $(this).closest('.category-item').data('id'); // Get the category ID from the clicked item

    // Check if the category already has details displayed
    let detailsDiv = $(this).closest('.category-item').next('.category-details');
    if (detailsDiv.length) {
        // If details are already visible, hide them
        detailsDiv.remove();
        return;  // Exit early, no need to make the AJAX call
    }
    // Fetch details from the server if not already displayed
    $.ajax({
        url: '/path/to/your/getSousCategoriesByCategoryId', // Replace with your actual route
        type: 'GET',
        data: { category_id: categoryId },
        success: function(response) {
            if (response.category) {
                // Call the function to display the category details
                displayCategoryDetails(response.category, $(this).closest('.category-item')[0]);
            } else {
                alert('Category not found.');
            }
        },
        error: function() {
            alert('Error fetching category details.');
        }
    });
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
            // Handle Delete Confirmation
            $('#confirm-delete-btn').click(function () {
                let categoryId = $('#delete-id').val();
            
                $.ajax({
                    url: '/admin/delete-categorie',
                    method: 'POST',
                    data: {
                        _method: 'DELETE', // Specify the method as DELETE
                        _token: $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
                        id: categoryId
                    },
                    success: function (response) {
                        alert('Category deleted successfully!');
                        location.reload(); // Reload the page to reflect changes
                    },
                    error: function (xhr) {
                        alert('Error: ' + xhr.responseText);
                    }
                });
            });
            // Handle Get Categorie
                $('#get-categorie-form').submit(function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();
                    $.ajax({
                        url: '/admin/get-categorie-by-id',  // Assuming this is the correct route
                        method: 'GET',
                        data: formData,
                        success: function(response) {
                            // Check if the response is successful
                            let category = response;
                            let imageUrl = "{{ asset('storage/') }}/" + category.image; // Build the image URL
            
                            // Display the category title and image
                            $('#get-category-result').html(`
                                <p>Category: ${category.titre}</p>
                                <p><img src="${imageUrl}" alt="Category Image" width="100" height="100"></p>
                            `);
                        },
                        error: function(xhr, status, error) {
                            alert("Error: " + xhr.responseText);
                        }
                    });
                });
                </script>
</body>
</html>