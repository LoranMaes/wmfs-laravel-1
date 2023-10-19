@extends('welcome')

@section('title', 'Blogotopia')

@section('pageContent')
<main class="container">
    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark banner" style="
            background-image: linear-gradient(
                    180deg,
                    rgba(255, 255, 255, 0) 0,
                    rgba(0, 0, 0, 0.35) 0
                ),
                url({{ url('storage/' . $posts[0]->image) }});
        ">
        <div class="col-md-6 px-0">
            <h1 class="display-4 fst-italic">{{ $posts[0]->title }}</h1>
            <p class="lead my-3">
                {{ $posts[0]->content }}
            </p>
            <p class="lead mb-0">
                <a href="{{ url('/blogposts/' . $posts[0]->id) }}" class="text-white fw-bold">Continue reading...</a>
            </p>
        </div>
    </div>

    <div class="row mb-2">
        @foreach ($posts as $post)
        @if (!$loop->first)
        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 category-2">{{ $post->category->title }}</strong>
                    <h3 class="mb-0">{{ $post->title }}</h3>
                    <div class="mb-1 text-muted">{{ $post->created_at }}</div>
                    <p class="card-text mb-auto">
                        {{ \Illuminate\Support\Str::limit($post->content, 120) }}
                    </p>
                    @include('partials/tags')
                    <a href="{{ url('/blogposts/' . $post->id) }}" class="stretched-link">Continue reading</a>
                </div>
                <div class="col-auto d-none d-lg-block img-container">
                    <img src="{{ url('storage/' . $post->image) }}" alt="The jury all wrote down" />
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</main>
@endsection