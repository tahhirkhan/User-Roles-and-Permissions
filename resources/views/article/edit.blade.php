

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <x-navbar>

    </x-navbar>

    <div class="container">
        
        <div class="d-flex justify-content-between mt-4">
            <h2 class="h2">Edit Article</h2>
        </div> 
        
        <div class="mt-4">
            <form method="POST" action="/edit-article/{{ $article->id }}">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="title" class="form-label">Article Title</label>
                    <input name="title" type="text" class="form-control border border-primary" id="title" value="{{ old('title', $article->title) }}">
                    @error('title')
                    <h5 class="text-sm text-bold text-danger">{{ $message }}</h5>
                    @enderror
                </div>
                

                <div class="mb-3">
                    <label for="body" class="form-label">Article Body</label>
                    <textarea name="body" class="form-control border border-primary" id="body" rows="20">{{ old('body', $article->body) }}</textarea>
                    @error('body')
                    <h5 class="text-sm text-bold text-danger">{{ $message }}</h5>
                    @enderror
                </div>
                

                <button type="submit" class="btn btn-primary">Update Article</button>

            </form>
        </div>             
        
    </div>

