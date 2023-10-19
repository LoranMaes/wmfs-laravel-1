@extends('welcome')

@section('title', 'Blogotopia | ' . $posts[0]->category->title)

@section('pageContent')
<main class="container">
    <div class="row g-5">
        <div class="col-md-8">
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                {{ $posts[0]->category->title }}
            </h3>
            @include('partials/blogposts')
        </div>

        @include('partials/sidebar')
    </div>
</main>
@endsection