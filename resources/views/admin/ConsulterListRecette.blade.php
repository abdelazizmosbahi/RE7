<!-- Add Navigation Buttons to Other Pages -->
<div>
    <h1>User - Consulter list recette user</h1>
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
    <title>Admin gerer recette</title>
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
                            <span data-key="t-dashboards">Gérer Catégorie</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/souscategorie" class="nav-link">
                            <span data-key="t-dashboards" >Gérer Sous-Catégorie</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/consulter-list-recette" class="nav-link">
                            <span data-key="t-dashboards" style=" color: orange;">Gérer Recette</span>
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
                <div class="row">
                    <div class="col-12">

                    </div>
                </div>

                <div class="container">
                    <h2>Liste des Recettes</h2>
            
                    <table class="table table-bordered mt-4" id="recettes-table">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                {{-- <th>Catégorie</th> --}}
                                {{-- <th>Sous-Catégorie</th> --}}
                                <th>Ingrédients</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Recettes will be dynamically loaded here via JavaScript -->
                        </tbody>
                    </table>
                </div>

                <script>
                 // Fetch all recettes and populate the table
window.addEventListener('DOMContentLoaded', function() {
    fetchRecettes();
});

// function fetchRecettes() {
//     fetch('/user/recettes')  // Ensure this endpoint returns the data in the format above
//         .then(response => response.json())
//         .then(data => {
//             const recettesTable = document.getElementById('recettes-table').getElementsByTagName('tbody')[0];
//             recettesTable.innerHTML = '';  // Clear previous data

//             data.forEach((recette, index) => {
//                 const row = recettesTable.insertRow();
//                 row.innerHTML = `
//                     <td>${recette.titre}</td>
//                     <td>${recette.ingredients}</td>
//                     <td>${recette.status}</td>
//                     <td>${recette.created_at}</td>
//                     <td>${recette.updated_at}</td>

//                     <td>
//                         <button class="btn btn-warning btn-sm" onclick="window.location.href='/recette/edit/${recette.id}'">Edit</button>
//                         <button class="btn btn-danger btn-sm" onclick="deleteRecette(${recette.id})">Delete</button>
//                     </td>
//                 `;
//             });
//         })
//         .catch(error => console.error('Error fetching recettes:', error));
// }

function fetchRecettes() {
    fetch('/user/recettes')  // Ensure this endpoint returns the data in the format above
        .then(response => response.json())
        .then(data => {
            const recettesTable = document.getElementById('recettes-table').getElementsByTagName('tbody')[0];
            recettesTable.innerHTML = '';  // Clear previous data

            // Inject the CSS for styling the status options
            const style = document.createElement('style');
            style.innerHTML = `
                /* Apply colors for the select dropdown background */
                .status-select {
                    background-color: white; /* Default background */
                    color: black;
                }

                .status-acceptée {
                    background-color: green;
                    color: white;
                }

                .status-en-cours {
                    background-color: orange;
                    color: white;
                }

                .status-refusée {
                    background-color: red;
                    color: white;
                }

                /* Optional: Add a color when the select dropdown is clicked */
                .status-select:focus {
                    border-color: #5c636a;
                    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
                }
            `;
            document.head.appendChild(style);

            // Populate the table with the fetched data
            data.forEach((recette, index) => {
                const row = recettesTable.insertRow();
                row.innerHTML = `
                    <td>${recette.titre}</td>
                    <td>${recette.ingredients}</td>
                    <td>
                        <select id="status-select-${recette.id}" class="form-control status-select" onchange="updateStatus(${recette.id})">
                            <option value="acceptée" class="status-acceptée" ${recette.status === 'acceptée' ? 'selected' : ''}>Acceptée</option>
                            <option value="en cours" class="status-en-cours" ${recette.status === 'en cours' ? 'selected' : ''}>En Cours</option>
                            <option value="refusée" class="status-refusée" ${recette.status === 'refusée' ? 'selected' : ''}>Refusée</option>
                        </select>
                    </td>
                    <td>${recette.created_at}</td>
                    <td>${recette.updated_at}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="window.location.href='/recette/edit/${recette.id}'">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteRecette(${recette.id})">Delete</button>
                    </td>
                `;
            });
        })
        .catch(error => console.error('Error fetching recettes:', error));
}

function updateStatus(id) {
    const status = document.getElementById('status-select-' + id).value;

    fetch(`/recette/update-status/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Statut mis à jour avec succès') {
            alert('Le statut a été mis à jour avec succès');
            fetchRecettes(); // Refresh the list to show the updated status
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error updating status:', error);
        alert('An error occurred while updating the status. Please try again.');
    });
}


function deleteRecette(id) {
    if (confirm('Are you sure you want to delete this recette?')) {
        fetch(`/recette/delete/${id}`, { method: 'GET' })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                fetchRecettes();  // Refresh the list
            })
            .catch(error => console.error('Error deleting recette:', error));
    }
}

function editRecette(id) {
    // Redirect to edit page (or show a modal for editing)
    window.location.href = `/recette/edit/${id}`;
}

                </script>                
            </div>
        </div>
    </div>

    
                
  {{--                     <td>${recette.categorie ? recette.categorie.titre : 'N/A'}</td>
 --}}

</body>
</html>