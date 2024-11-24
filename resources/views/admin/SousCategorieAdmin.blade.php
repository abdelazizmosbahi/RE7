<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sous Categorie</title>
</head>
<body>
    <h1>Add Sous Categorie</h1>

    <!-- Form to add Sous Categorie -->
    <form action="/admin/add-sous-categorie" method="POST">
        @csrf
        <h3>Fill out the details for the new Sous Categorie</h3>

        <!-- Input for the titre -->
        <input type="text" name="titre" placeholder="Titre" required>

        <!-- Input for the image -->
        <input type="text" name="image" placeholder="Image" required>

        <!-- Dropdown to select the parent category -->
        <select name="categorie_id" required>
            <option value="" disabled selected>Select a Category</option>
            @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}">{{ $categorie->titre }}</option>
            @endforeach
        </select>

        <button type="submit">Add Sous Categorie</button>
    </form>


    <!-- Get All Sous Categories -->
<a href="/admin/get-all-sous-categories">View All Sous Categories</a>
<!-- Get Sous Categorie By ID -->
<form action="/admin/get-sous-categorie-by-id/" method="GET" onsubmit="this.action = this.action + document.getElementById('sousCategorieId').value">
    <h3>Get Sous Categorie By ID</h3>
    <input type="number" id="sousCategorieId" name="id" placeholder="Enter Sous Categorie ID" required>
    <button type="submit">Get Sous Categorie</button>
</form>
<!-- Delete Sous Categorie -->
<form action="/admin/delete-sous-categorie" method="POST">
    @csrf
    @method('DELETE')
    <h3>Delete Sous Categorie</h3>
    <input type="number" name="id" placeholder="Enter Sous Categorie ID to Delete" required>
    <button type="submit">Delete</button>
</form>
<!-- Update Sous Categorie -->
<form action="/admin/update-sous-categorie" method="POST">
    @csrf
    @method('PUT')
    <h3>Update Sous Categorie</h3>
    
    <!-- Input for the ID -->
    <input type="number" name="id" placeholder="Enter Sous Categorie ID to Update" required>
    
    <!-- Input for the title -->
    <input type="text" name="titre" placeholder="Enter New Title" required>
    
    <!-- Input for the image -->
    <input type="text" name="image" placeholder="Enter New Image URL" required>

    <!-- Input for the category ID -->
    <select name="categorie_id" required>
        <option value="" disabled selected>Select a Category</option>
        @foreach($categories as $categorie)
            <option value="{{ $categorie->id }}">{{ $categorie->titre }}</option>
        @endforeach
    </select>
    <button type="submit">Update</button>
</form>

</body>
</html>
