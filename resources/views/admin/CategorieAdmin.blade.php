<!-- Add Navigation Buttons to Other Pages -->
<div>
    <h1> admin -  ajouter categorie admin </h1>
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Categorie</title>
</head>
<body>
    <h1>Test API Endpoints</h1>

    <!-- Add Categorie -->
    <form action="/admin/add-categorie" method="POST">
        @csrf
        <h3>Add Categorie</h3>
        <input type="text" name="titre" placeholder="Titre" required>
        <input type="text" name="image" placeholder="Image" required>
        <button type="submit">Add</button>
    </form>

<!-- Update Categorie -->
<form action="/admin/update-categorie" method="POST">
    @csrf
    @method('PUT')
    <h3>Update Categorie</h3>
    
    <!-- Input for the ID -->
    <input type="number" name="id" placeholder="Enter Category ID to Update" required>
    
    <!-- Input for the title -->
    <input type="text" name="titre" placeholder="Enter New Title" required>
    
    <!-- Input for the image -->
    <input type="text" name="image" placeholder="Enter New Image URL" required>
    
    <button type="submit">Update</button>
</form>


    <!-- Delete Categorie -->
<!-- Delete Categorie -->
<form action="/admin/delete-categorie" method="POST">
    @csrf
    @method('DELETE')
    <h3>Delete Categorie</h3>
    <input type="number" name="id" placeholder="Enter Category ID to Delete" required>
    <button type="submit">Delete</button>
</form>


    <!-- Get All Categories -->
    <a href="/admin/get-all-categories">Get All Categories</a>

<!-- Get Categorie By ID -->
<form action="/admin/get-categorie-by-id" method="GET">
    <h3>Get Categorie By ID</h3>
    <input type="number" name="id" placeholder="Enter Category ID" required>
    <button type="submit">Get</button>
</form>

</body>
</html>




