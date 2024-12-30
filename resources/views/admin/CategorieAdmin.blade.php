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
                            <span data-key="t-dashboards" style=" color: orange;">Gérer Catégorie</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/souscategorie" class="nav-link">
                            <span data-key="t-dashboards" >Gérer Sous-Catégorie</span>
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
            <h5 class="modal-title" id="updateModalLabel">Modifier catégorie</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="update-id" name="id">
            <div class="mb-3">
              <label for="update-title" class="form-label">Titre</label>
              <input type="text" class="form-control" id="update-title" name="titre" required>
            </div>
            <div class="mb-3">
              <label for="update-image" class="form-label">Image</label>
              <input type="file" class="form-control" id="update-image" name="image" accept="image/*">
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
          <h5 class="modal-title" id="deleteModalLabel">Supprimer la catégorie</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Êtes-vous sûr de vouloir supprimer cette catégorie ?
          <input type="hidden" id="delete-id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-danger" id="confirm-delete-btn">Supprimer</button>
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
                                <div id="add-success-message" class="mt-3" style="display:none; color:green;">Catégorie ajoutée avec succès !</div>
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
                    listItem.className = 'list-group-item d-flex justify-content-start align-items-center';

                    // Flex container for image and titles (category title)
                    const titleDiv = document.createElement('div');
                    titleDiv.className = 'd-flex flex-column ms-3'; // Use flex column to stack titles vertically

                    // Image of the category
                    const image = document.createElement('img');
                    image.src = `{{ asset('storage/') }}/${category.image}`; // Image URL for category
                    image.alt = category.titre;
                    image.style.width = '100px';
                    image.style.height = '100px';

                    // Title of the category
                    const title = document.createElement('span');
                    title.textContent = category.titre; // Title of category
                    title.style.cursor = 'pointer';
                    title.classList.add('mt-2'); // Add margin to the top of category title
                    title.addEventListener('click', () => {
                        // Redirect to the category details page with the correct URL format
                        window.location.href = `/admin/categorie/${category.id}`;
                    });

                    // Append image and title to the titleDiv
                    titleDiv.appendChild(title);

                    // Add spacing between titles and buttons
                    const spacingDiv = document.createElement('div');
                    spacingDiv.style.marginLeft = '240px'; // You can adjust this value

                    // Append image, titleDiv, and spacingDiv to the list item
                    listItem.appendChild(image);
                    listItem.appendChild(titleDiv);
                    listItem.appendChild(spacingDiv);

                    // Add delete button
                    const deleteButton = document.createElement('button');
                    deleteButton.className = 'btn btn-danger btn-sm';
                    deleteButton.textContent = 'Supprimer';
                    deleteButton.addEventListener('click', () => showDeleteModal(category.id));
                    listItem.appendChild(deleteButton);

                    // Add update button
                    const updateButton = document.createElement('button');
                    updateButton.className = 'btn btn-warning btn-sm ms-2'; // Add margin to the left of the update button
                    updateButton.textContent = 'Modifier';
                    updateButton.addEventListener('click', () => showUpdateModal(category));
                    listItem.appendChild(updateButton);

                    // Append the list item to the list
                    list.appendChild(listItem);
                });

                // Append the list to the main container
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
            // Handle Delete Modal
            function showDeleteModal(categoryId) {
                // Set the category ID to delete
                $('#delete-id').val(categoryId);
                // Show the modal
                $('#deleteModal').modal('show');
            }            

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
            // Handle Update Modal
            function showUpdateModal(category) {
                // Set the modal fields with the category data
                $('#update-id').val(category.id);
                $('#update-title').val(category.titre);
                // Show the modal
                $('#updateModal').modal('show');
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