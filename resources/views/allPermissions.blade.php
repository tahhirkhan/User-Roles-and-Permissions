
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Permissions</title>
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

    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Create Permission
                </button> -->

    <div class="container d-flex justify-content-between my-4">
        <h2 class="h5">Permissions</h2>
        @can('create-permissions')
        <div>
          <a href="/create-permission" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-circle"></i> Permission</a>
        </div> 
        @endcan 
    </div>


    <!--Create Permission Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" 
    @if ($errors->any()) style="display: block;" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Permission</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-2">
                    <form id="permissionForm" action="/create-permission" method="POST">
                        @csrf
                        <!-- <input type="hidden" name="createForm" value="create"> -->
                        <label for="value" class="form-label">Permission Type</label>
                        <select class="form-select border border-primary mb-3" name="permissionType" aria-label="Default select example">
                            @foreach ($permissionTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <div class="mb-3">
                            <label for="preference" class="form-label">Permission Name</label>
                            <input type="text" name="permission" class="form-control border border-primary" id="permission"
                                value="{{ old('permission') }}">
                            @error('permission')
                                <p class="text-sm text-danger"><strong>{{ $message }}</strong></p>
                            @enderror
                        </div>  
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Update Permission Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateModalLabel">Update Preference</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-2">
                <form id="permissionForm" action="/update-permission" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label for="permission" class="form-label">Permission Name</label>
                            <input type="text" name="permission" class="form-control border border-primary" id="permission"
                                value="{{ old('permission') }}">
                            @error('permission')
                                <p class="text-sm text-danger"><strong>{{ $message }}</strong></p>
                            @enderror
                        </div>  
                        <!-- <div class="mb-3">
                            <label for="preference" class="form-label">Charge Name</label>
                            <input type="text" name="charge" class="form-control border border-primary" id="charge" 
                                value="{{ old('charge') }}">
                            @error('charge')
                                <p class="text-sm text-danger"><strong>{{ $message }}</strong></p>
                            @enderror
                        </div> -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





    

    <div class="container-fluid px-3">
    <table class="table">
        <thead>
            <tr class="table-secondary">
                <th>ID</th>
                <th>Name</th>
                <th>Guard Name</th>
                <th>Created At</th>
                <th>Updated At</th>
                @can('edit-permissions')
                <th>Actions</th>
                @endcan
            </tr>
        </thead>
        @foreach ($permissions as $permission)
            <tbody>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>
                <td>{{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($permission->updated_at)->format('d M, Y') }}</td>
                @can('edit-permissions')
                <td>
                    <a href="#"
                        class="edit-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#updateModal"
                        data-id = "{{ $permission->id }}"
                        data-name = "{{ $permission->name  }}"

                         ><i class="btn btn-primary bi bi-pencil-square"></i></a>
                    <a href="/delete-permission/{{ $permission->id }}" class="btn btn-danger delete-button">
                        <i class="bi bi-trash-fill"></i>
                    </a>
                </td>
                @endcan
            </tbody>
        @endforeach
            
    </table>
    <!-- <div class="d-flex justify-content-center">
        
    </div> -->
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
                    document.querySelector('#updateModal input[name="permission"]').value = name;
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
