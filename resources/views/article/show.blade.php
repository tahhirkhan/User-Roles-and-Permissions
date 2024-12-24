

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <x-navbar>
        
    </x-navbar>
    
    <div class="container">

    <div class="d-flex justify-content-between mt-4">
        <a href="#">
                {{ $article->author }}
        </a>
        <div class="d-flex flex-row-reverse gap-2">

            @if (auth()->user()->name === $article->author)
                @can('delete-articles')
                <div>
                    <form method="POST" action="/delete-article/{{ $article->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger">Delete</button>
                    </form>
                </div>
                @endcan

                @can('edit-articles')
                <div>
                    <a href="/edit-article/{{ $article->id }}" class="btn btn-outline-dark">Edit</a>
                </div> 
                @endcan   
            @endif
        
        </div>
    </div>
        

        <div class="d-flex justify-content-between mt-4">
            <h2 class="h2">{{ $article->title }}</h2>
            
        </div>

        <div class="mt-3">
            <p>{{ $article->body }}</p>
        </div>

    </div>
