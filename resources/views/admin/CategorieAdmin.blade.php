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



<hr>
<form action="{{ url('/admin/add-categorie') }}" method="POST">
    @csrf
    <div>
        <label for="titre">Title</label>
        <input type="text" name="titre" id="titre" required>
    </div>
    <div>
        <label for="image">Image</label>
        <input type="text" name="image" id="image" required>
    </div>
    <button type="submit">Add Category</button>
</form>
<hr>



