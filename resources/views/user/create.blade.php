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
        <form class="card py-4 px-3 border border-primary-subtle" style="width: 500px;" action="/create-user" method="POST">

          <h3 class="my-4 text-center h4">CREATE USER</h3>
          @csrf
          <div class="mb-3">
              <label for="name" class="form-label"><strong>Name</strong></label>
              <input type="text" name="name" class="form-control border border-primary-subtle" id="name" value="{{ old('name') }}">
              @error('name')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
          <div class="mb-3">
              <label for="email" class="form-label"><strong>Email</strong></label>
              <input type="email" name="email" class="form-control border border-primary-subtle" id="email" value="{{ old('email') }}">
              @error('email')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
          <div class="mb-3">
              <label for="role" class="form-label"><strong>Password</strong></label>
              <input type="password" name="password" class="form-control border border-primary-subtle" id="password" value="{{ old('password') }}">
              @error('password')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
          <div class="mb-4">
            <div class="row">
            <label class="form-label"><strong>Roles</strong></label>
              @foreach ($allRoles as $role)
                <div class="col-md-4">
                  <input type="checkbox" class="form-check-input border border-primary-subtle" name="roles[]" id="role-{{ $role->id }}" value="{{ $role->name }}">
                  <label for="demoId">{{ $role->name }}</label>
                </div>
              @endforeach
            </div>
          </div>
            
            
            <button type="submit" class="btn btn-primary">submit</button>
        </form>
      </div>

    
</body>
</html>