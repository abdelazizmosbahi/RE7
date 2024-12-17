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
            <th>Stars</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Recette Title</th> <!-- Column for recette title -->
        </tr>
    </thead>
    <tbody>
        @foreach ($rates as $rate)
        <tr>
            <td>{{ $rate->stars }}</td>
            <td>{{ $rate->comment }}</td>
            <td>
                <form action="{{ route('rate.updateStatus', $rate->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-control" onchange="this.form.submit()">
                        <option value="in progress" {{ $rate->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="approved" {{ $rate->status == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="deleted" {{ $rate->status == 'deleted' ? 'selected' : '' }}>Deleted</option>
                    </select>
                </form>
            </td>
            <!-- Displaying the recette's title -->
            <td>{{ $rate->recette->titre }}</td> <!-- Accessing the titre of the related recette -->
        </tr>
        @endforeach
    </tbody>
</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
