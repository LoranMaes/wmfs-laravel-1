@extends('welcome')

@section('title', 'Add a blogpost')

@section('pageContent')
<main class="container">

    <div class="row p-4 m-5 mb-5 bg-light rounded">
        <h3 class="mb-3">Search blogposts</h3>
        <form class="needs-validation" novalidate="" method="get" action="{{ url('/blogposts/search/') }}">
            <div class="row g-3">


                <div class="col-12 col-md-6">
                    <label for="term" class="form-label">Search term(s)</label>
                    <input type="text" class="form-control" id="term" placeholder="" name="term"
                        value="{{ request('term', '') }}">
                </div>

                <div class="col-12 col-md-6">
                    <label for="tags" class="form-label">Containg at least 1 of following tags</label>
                    <input type="text" class="form-control" id="tags" placeholder="" name="tags"
                        value="{{ request('tags', '') }}">
                </div>


                <div class="col-12 col-md-6">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category" required="" name="category_id">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (request('category_id', '' )==$category->id)
                            selected="selected" @endif>{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label for="author" class="form-label">Author</label>
                    <select class="form-select" id="author" required="" name="author_id">
                        @foreach ($authors as $author)
                        <option value="{{ $author->id }}" @if (request('author_id', '' )==$author->id)
                            selected="selected" @endif>{{ $author->first_name }} {{ $author->last_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label for="after" class="form-label">Blogposts after</label>
                    <input type="datetime-local" class="form-control" id="after" placeholder="" name="after"
                        value="{{ request('after', '') }}">
                </div>

                <div class="col-12 col-md-6">
                    <label for="before" class="form-label">Blogposts before</label>
                    <input type="datetime-local" class="form-control" id="before" placeholder="" name="before"
                        value="{{ request('before', '') }}">
                </div>
            </div>


            <hr class="my-4">

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="sort" class="form-label">Sort by</label>
                    <select class="form-select" id="sort" required="" name="sort">
                        <option value="most_recent" @if (request('sort', '' )=='most_recent' ) selected @endif>most
                            recent</option>
                        <option value="less_recent" @if (request('sort', '' )=='less_recent' ) selected @endif>less
                            recent</option>
                        <option value="title" @if (request('sort', '' )=='title' ) selected @endif>title</option>
                    </select>
                </div>


            </div>

            <hr class="my-4">

            <button class="btn btn-primary btn-lg" type="submit">Search</button>
        </form>

    </div>


    <div class="row mb-2">
        <h4 class="mb-4">
            <a id="results"></a>
            Search results
        </h4>
        @if ($blogposts->count())
        @foreach ($blogposts as $post)
        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 category-9">{{ $post->category->title }}</strong>
                    <h3 class="mb-0">{{ $post->title }}</h3>
                    @include('partials/tags')
                    <div class="mb-1 text-muted">{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                    </div>
                    <p class="card-text mb-auto">{{ Str::limit($post->content, 100, ' ...') }}</p>
                    <a href="{{ url('/blogposts/' . $post->id) }}" class="stretched-link">Continue reading</a>
                </div>
                <div class="col-auto d-none d-lg-block img-container">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" />
                </div>
            </div>
        </div>
        @endforeach
        @else
        <p><strong>No blogposts where found.</strong></p>
        @endif

        <nav>
            {{ $blogposts->links() }}
        </nav>

    </div>

</main>
@endsection