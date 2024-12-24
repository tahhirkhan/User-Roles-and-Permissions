

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
    
    <div class="container">
        
        <!-- <div class="d-flex justify-content-between mt-4">
            <h2 class="h2">All Articles</h2>
            <a href="/create-article">
                <x-primary-button>Create</x-primary-button>
            </a>
        </div> -->

        <div class="container d-flex justify-content-between my-4">
            <h2 class="h5">Articles</h2>
            @can('create-articles')
            <div>
            <a href="/create-article" class="btn btn-sm btn-primary"><i class="bi bi-plus-circle"></i> Article</a>
            </div>  
            @endcan
        </div>

        @foreach ($articles as $article)
            <div class="card mt-2">
                <div class="card-header">
                <div>Author : {{ $article->author }}</div>
                </div>
                <div class="card-body">
                    <h5 class="card-title pb-2">{{ $article->title }}</h5>
                    <!-- <p class="card-text"></p> -->
                    <a href="/show-article/{{ $article->id }}" class="btn btn-sm btn-outline-dark">Read Full Article</a>
                </div>
            </div>
        @endforeach

        <div class="mt-2">
            
        </div>
    
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
    