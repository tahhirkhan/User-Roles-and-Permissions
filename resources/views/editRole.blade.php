<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

      <x-navbar>
      
      </x-navbar>

      <div class="container d-flex justify-content-center align-items-center mt-5">
        <form class="card py-4 px-3 border border-primary-subtle" style="width: 600px;" action="/update-role/{{ $role->id }}" method="POST">

          <h3 class="my-4 text-center h4">UPDATE ROLE</h3>
          @csrf
          @method('PATCH')
          <div class="mb-3">
              <label for="role" class="form-label"><strong>Role Name</strong></label>
              <input type="text" name="role" class="form-control border border-primary-subtle" id="role" value="{{ old('role', $role->name) }}">
              @error('role')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>

          <div class="">
            <div class="row">
              <label class="form-label"><strong>Permission Types</strong></label>
              @foreach ($permissionTypes as $type)
              <div class="accordion mb-3" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{ $type->id }}" aria-controls="collapseOne-{{ $type->id }}">
                      {{ $type->name }}
                    </button>
                  </h2>
                  <div id="collapseOne-{{ $type->id }}" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                      <div class="row">
                        <!-- <label class="form-label"><strong>Permissions</strong></label> -->
                        @foreach ($allPermissions as $permission)
                          <!-- <div class="col-md-4"> -->
                            @if ($type->id == $permission->permission_type)
                            <div class="col-md-4">
                            <input {{ ($hasPermissions->contains($permission->name)) ? 'checked' : '' }} type="checkbox" class="form-check-input border border-primary-subtle" name="permissions[]" id="permission-{{ $permission->id }}" value="{{ $permission->name }}">
                            <label for="demoId">{{ $permission->name }}</label>
                            </div>
                            @endif
                          <!-- </div> -->
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <!-- <div class="mb-4">
            <div class="row">
            <label class="form-label"><strong>Permissions</strong></label>
              @foreach ($allPermissions as $permission)
                <div class="col-md-4">
                  <input {{ ($hasPermissions->contains($permission->name)) ? 'checked' : '' }} type="checkbox" class="form-check-input border border-primary-subtle" name="permissions[]" id="permission-{{ $permission->id }}" value="{{ $permission->name }}">
                  <label for="demoId">{{ $permission->name }}</label>
                </div>
              @endforeach
            </div>
          </div> -->
            
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>