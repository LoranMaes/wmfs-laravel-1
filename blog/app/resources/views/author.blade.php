@extends('welcome')

@section('title', 'Blogotopia | ' . $author->first_name . ' ' . $author->last_name)

@section('pageContent')
<main class="container">
    <div class="row g-5">
        <div class="col-md-8">
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                {{ $author->first_name }} {{ $author->last_name }}
            </h3>
            <div class="p-4 mb-3 bg-light rounded">
                <h4 class="fst-italic">About {{ $author->first_name }} {{ $author->last_name }}</h4>
                <p class="mb-0">
                    {{ $author->first_name }} {{ $author->last_name }} lives at {{
                    $author->location }}.
                    You can find more information about {{ $author->first_name }} on <a target="_blank"
                        href="{{ $author->website }}">{{ $author->website }}</a>.
                </p>
            </div>

            @include('partials/blogposts')
        </div>

        @include('partials/sidebar')
    </div>
</main>
@endsection