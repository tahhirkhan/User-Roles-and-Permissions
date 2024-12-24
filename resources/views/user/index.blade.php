
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Roles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">



</head>
<body>

    <!-- toast start -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toastMessage" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <!-- toast end -->

    <x-navbar>
      
    </x-navbar>

    <div class="container d-flex justify-content-between my-4">
        <h2 class="h5">Users</h2>
        @can('create-users')
        <div>
          <a href="/create-user" class="btn btn-sm btn-primary"><i class="bi bi-plus-circle"></i> User</a>
        </div>  
        @endcan
    </div>
  

    <div class="container-fluid p-2">
    <table class="table">
        <thead>
            <tr class="table-secondary">
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Created At</th>
                <th>Updated At</th>
                @can('edit-users')
                <th>Actions</th>
                @endcan
            </tr>
        </thead>
        @foreach ($allUsers as $user)
            <tbody>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($user->updated_at)->format('d M, Y') }}</td>
                @can('edit-users')
                <td>
                    <a href="/edit-user/{{ $user->id }}"><i class="btn btn-primary bi bi-pencil-square"></i></a>
                    <a href="/delete-user/{{ $user->id }}" class="btn btn-danger delete-button">
                        <i class="bi bi-trash-fill"></i>
                    </a>

                </td>
                @endcan
            </tbody>
        @endforeach
            
        
    </table>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toastEl = document.getElementById('toastMessage');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            });
        </script>
    @endif

    

</body>
</html>
