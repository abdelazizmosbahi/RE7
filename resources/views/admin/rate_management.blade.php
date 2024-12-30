<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Rate Management</h2>

    <table class="table">
    <thead>
        <tr>
            <th>Note</th>
            <th>Commentaire</th>
            <th>Status</th>
            <th>Titre</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rates as $rate)
        <tr>
            <td>{{ $rate->stars }}</td>
            <td>{{ $rate->comment }}</td>
            <td>
                <form action="{{ route('rate.updateStatus', $rate->id) }}" method="POST" id="rate-form-{{ $rate->id }}">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-control status-select" data-rate-id="{{ $rate->id }}">
                        <option value="in progress" {{ $rate->status == 'in progress' ? 'selected' : '' }}>En cours</option>
                        <option value="approved" {{ $rate->status == 'approved' ? 'selected' : '' }}>Approuvé</option>
                        <option value="deleted" {{ $rate->status == 'deleted' ? 'selected' : '' }}>Supprimé</option>
                    </select>
                </form>
            </td>
            <td>{{ $rate->recette->titre }}</td>
        </tr>
        @endforeach
    </tbody>
    </table>

    <!-- Modal for Delete Confirmation -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Etes-vous sûr de vouloir supprimer ce tarif ?                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Attach the event listener to all the status select dropdowns
    document.querySelectorAll('.status-select').forEach(function(select) {
        select.addEventListener('change', function() {
            const selectedStatus = this.value;
            const rateId = this.getAttribute('data-rate-id');
            const deleteForm = document.getElementById('deleteForm');

            if (selectedStatus === 'deleted') {
                // Prevent the form from being submitted immediately
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
                
                // Set the delete form action with the correct rate ID
                deleteForm.action = '/rate/' + rateId + '/delete'; // Adjust the delete route if necessary
            } else {
                // If not deleted, submit the form directly
                document.getElementById('rate-form-' + rateId).submit();
            }
        });
    });
</script>

</body>
</html>
