

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="/dashboard">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"     aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNavAltMarkup">
            <div class="navbar-nav">

                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Permissions
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li> -->
                
                @can('view-roles')
                <a href="/all-roles" type="button" class="btn btn-primary">Roles</a>
                @endcan

                @can('view-permissions')
                <a href="/all-permissions" type="button" class="btn btn-primary">Permissions</a>
                @endcan

                @can('view-articles')
                <a href="/all-articles" type="button" class="btn btn-primary">Articles</a>
                @endcan

                @can('view-users')
                <a href="/all-users" type="button" class="btn btn-primary">Users</a>
                @endcan

                @can('View Category')
                <a href="/all-permission-categories" type="button" class="btn btn-primary">Permission Categories</a>
                @endcan

            </div>
            <!-- <div class="" role="search">
                <button class="btn btn-outline-info" type="submit">
                    @auth
                        <span class="text-white">{{ Auth::user()->name }} [{{ Auth::user()->roles()->pluck('name')->implode(', ') }}]</span>
                    @endauth
                </button>
            </div> -->
        </div>
    </div>
</nav>
