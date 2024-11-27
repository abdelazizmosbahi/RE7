<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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

        {{-- <!-- Update Categorie -->
        <div class="card mb-4">
            <div class="card-header">Update Categorie</div>
            <div class="card-body">
                <form id="update-categorie-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="id-update">Category ID</label>
                        <input type="number" id="id-update" name="id" class="form-control" placeholder="Enter Category ID to Update" required>
                    </div>
                    <div class="form-group">
                        <label for="titre-update">New Title</label>
                        <input type="text" id="titre-update" name="titre" class="form-control" placeholder="Enter New Title" required>
                    </div>
                    <div class="form-group">
                        <label for="image-update">New Image URL</label>
                        <input type="text" id="image-update" name="image" class="form-control" placeholder="Enter New Image URL" required>
                    </div>
                    <button type="submit" class="btn btn-warning mt-2">Update</button>
                </form>
                <div id="update-success-message" class="mt-3" style="display:none; color:green;">Category updated successfully!</div>
            </div>
        </div> --}}
        <!-- Update Categorie -->
<div class="card mb-4">
    <div class="card-header">Update Categorie</div>
    <div class="card-body">
        <form id="update-categorie-form" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Keep PUT method for updating -->
            <div class="form-group">
                <label for="id-update">Category ID</label>
                <input type="number" id="id-update" name="id" class="form-control" placeholder="Enter Category ID to Update" required>
            </div>
            <div class="form-group">
                <label for="titre-update">New Title</label>
                <input type="text" id="titre-update" name="titre" class="form-control" placeholder="Enter New Title" required>
            </div>
            <div class="form-group">
                <label for="image-update">New Image (Optional)</label>
                <input type="file" id="image-update" name="image" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-warning mt-2">Update</button>
        </form>
        <div id="update-success-message" class="mt-3" style="display:none; color:green;">Category updated successfully!</div>
    </div>
</div>


        <!-- Delete Categorie -->
        <div class="card mb-4">
            <div class="card-header">Delete Categorie</div>
            <div class="card-body">
                <form id="delete-categorie-form">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <label for="id-delete">Category ID</label>
                        <input type="number" id="id-delete" name="id" class="form-control" placeholder="Enter Category ID to Delete" required>
                    </div>
                    <button type="submit" class="btn btn-danger mt-2">Delete</button>
                </form>
                <div id="delete-success-message" class="mt-3" style="display:none; color:green;">Category deleted successfully!</div>
            </div>
        </div>

        <!-- Get All Categories -->
        <div class="mb-4">
            <button id="get-all-categories-btn" class="btn btn-info">Get All Categories</button>
            <div id="all-categories-list" class="mt-3"></div>
        </div>


        <!-- Get Categorie By ID -->
        <div class="card">
            <div class="card-header">Get Categorie By ID</div>
            <div class="card-body">
                <form id="get-categorie-form">
                    <div class="form-group">
                        <label for="id-get">Category ID</label>
                        <input type="number" id="id-get" name="id" class="form-control" placeholder="Enter Category ID" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Get</button>
                </form>
                <div id="get-category-result" class="mt-3">
                    <!-- Category result will be displayed here -->
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

        // // Handle Update Categorie
        // $('#update-categorie-form').submit(function(e) {
        //     e.preventDefault();
        //     let formData = $(this).serialize();
        //     $.ajax({
        //         url: '/admin/update-categorie',
        //         method: 'POST',
        //         data: formData,
        //         success: function(response) {
        //             $('#update-success-message').show();
        //             $('#update-categorie-form')[0].reset();
        //         },
        //         error: function(xhr, status, error) {
        //             alert("Error: " + xhr.responseText);
        //         }
        //     });
        // });
        // Handle Update Categorie
$('#update-categorie-form').submit(function(e) {
    e.preventDefault();

    // Create FormData to handle file uploads and other form data
    let formData = new FormData(this);

    $.ajax({
        url: '/admin/update-categorie',  // Ensure this is the correct endpoint for updating
        method: 'POST',
        data: formData,
        processData: false, // Required for FormData
        contentType: false, // Required for FormData
        success: function(response) {
            $('#update-success-message').show();
            $('#update-categorie-form')[0].reset();
        },
        error: function(xhr, status, error) {
            alert("Error: " + xhr.responseText);
        }
    });
});


        // Handle Delete Categorie
        $('#delete-categorie-form').submit(function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url: '/admin/delete-categorie',
                method: 'POST',
                data: formData,
                success: function(response) {
                    $('#delete-success-message').show();
                    $('#delete-categorie-form')[0].reset();
                },
                error: function(xhr, status, error) {
                    alert("Error: " + xhr.responseText);
                }
            });
        });

        // Handle Get All Categories
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
                    listItem.className = 'list-group-item';
                    
                    // Add category title
                    const title = document.createElement('strong');
                    title.textContent = category.titre;
                    listItem.appendChild(title);
                    
                    // Add category image
                    const image = document.createElement('img');
                    image.src = "{{ asset('storage/') }}/" + category.image; // Corrected image path
                    image.alt = category.titre;
                    image.style.maxWidth = '150px';
                    image.style.display = 'block';
                    image.style.marginTop = '10px';
                    listItem.appendChild(image);
                    
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
