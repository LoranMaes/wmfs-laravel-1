@extends('welcome')

@section('title', 'Blogotopia | ' . $post->title)

@section('pageContent')
<main class="container">
    <div class="row g-5">
        <div class="col-md-8">
            <article class="blog-post">
                <h2 class="blog-post-title">{{ $post->title }}</h2>
                <p class="blog-post-meta">{{ \Carbon\Carbon::parse($post->created_at)->format('F d, o') }} by <a
                        href="{{ url('/authors/' . $post->author->id) }}">{{ $post->author->first_name }} {{
                        $post->author->last_name }}</a></p>
                @include('partials/tags')
                <p><img src="{{ asset('/storage/' . $post->image) }}" class="rounded" alt="{{ $post->title }}">
                </p>
                <p>{{ $post->content }}</p>

                @can('delete-post', $post)
                <form action="{{ url('blogposts/' . $post->id . '/delete') }}" method="POST">
                    <button class="btn btn-sm btn-outline-secondary" type="submit">Delete post</button>
                    @csrf
                </form>
                @endcan
                @include('partials/comments')
            </article>
        </div>
        @include('partials/sidebar')
    </div>
</main>
@endsection