
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
        <h2 class="h5">Roles</h2>
        @can('create-roles')
        <div>
          <a href="/create-role" class="btn btn-sm btn-primary"><i class="bi bi-plus-circle"></i> Role</a>
        </div>  
        @endcan
    </div>
      


    <div class="container-fluid p-2">
    <table class="table">
        <thead>
            <tr class="table-secondary">
                <th>ID</th>
                <th>Name</th>
                <th>Permissions</th>
                <th>Created At</th>
                <th>Updated At</th>
                @can('edit-roles')
                <th>Actions</th>
                @endcan
            </tr>
        </thead>
        @foreach ($roles as $role)
            <tbody>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <!-- <td>{{ $role->guard_name }}</td> -->
                <td style="max-width: 400px;">
                    <table class="table table-bordered">
                        @foreach ($permissionData as $type => $permissions) 
                        @php

                            $permissionNames = array_column($permissions, 'name');
                            $permissionNamesString = '';
                            foreach ($permissionNames as $permissionName) {
                                if ($role->hasPermissionTo($permissionName)) {
                                    $permissionNamesString .= $permissionName. ', ';
                                } 
                            }
                            $permissionNamesString = rtrim($permissionNamesString, ', ');
                            echo "<tr class='permission-row' data-permission-names='$permissionNamesString'>";
                            echo "<th class='col-md-4'>$type</th>";
                            echo "<td>$permissionNamesString</td>";
                            echo "</tr>";
                            @endphp
                        @endforeach


                    </table>    
                </td>
                <td>{{ \Carbon\Carbon::parse($role->created_at)->format('d M, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($role->updated_at)->format('d M, Y') }}</td>
                @can('edit-roles')
                <td>
                    <a href="/edit-role/{{ $role->id }}"><i class="btn btn-primary bi bi-pencil-square"></i></a>
                    <a href="/delete-role/{{ $role->id }}" class="btn btn-danger delete-button">
                        <i class="bi bi-trash-fill"></i>
                    </a>
                </td>
                @endcan
            </tbody>
        @endforeach
            
        
    </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                myModal.show();
            });
        </script>
    @endif


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            const editButtons = document.querySelectorAll('.edit-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    
                    document.querySelector('#updateModal input[name="id"]').value = id;
                    document.querySelector('#updateModal input[name="role"]').value = name;
                    // document.querySelector('#updateModal input[name="status"]').checked = status == "1";
                    // document.querySelector('#updateModal select[name="status"]').value = status;

                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            var addPreferenceButton = document.querySelector('[data-bs-toggle="modal"][data-bs-target="#exampleModal"]');
            var preferenceModal = document.getElementById('exampleModal');
            
            addPreferenceButton.addEventListener('click', function() {
                // Clear all input fields except CSRF token
                var inputs = preferenceModal.querySelectorAll('input:not([name="_token"]), select');
                inputs.forEach(function(input) {
                    input.value = '';
                });

                var uniqueErrorDiv =preferenceModal.querySelectorAll('.alert.alert-danger')
                uniqueErrorDiv.forEach(function(ed) {
                    ed.textContent = '';
                });
                var errorDivs = preferenceModal.querySelectorAll('.text-sm.text-danger');
                errorDivs.forEach(function(errorDiv) {
                    errorDiv.textContent = '';
                });
            });
        });

    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Select all rows with the class "permission-row"
            const rows = document.querySelectorAll(".permission-row");
            
            rows.forEach(row => {
                const permissionNames = row.getAttribute("data-permission-names");
                
                // Check if permissionNames is empty
                if (!permissionNames.trim()) {
                    row.style.display = "none"; // Hide the row
                }
            });
        });
    </script>

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
