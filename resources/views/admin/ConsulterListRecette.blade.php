{{-- <!-- Add Navigation Buttons to Other Pages -->
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
</html> --}}
