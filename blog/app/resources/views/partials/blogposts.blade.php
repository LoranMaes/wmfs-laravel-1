@if (count($posts) > 0)
@foreach ($posts as $post)
<article class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">{{ \Carbon\Carbon::parse($post->created_at)->format('F d, o') }} by <a
            href="{{ url('/authors/' . $post->author->id) }}">{{ $post->author->first_name }} {{
            $post->author->last_name }}</a></p>
    <p><img src="{{ url('/storage/' . $post->image) }}" class="rounded" alt="Frog-Footman repeated">
    </p>
    <p>{{ $post->content }}</p>
    @include('partials/tags')
    <a href="{{ url('/blogposts/' . $post->id) }}">Read comments &hellip;</a>
</article>
@endforeach
@else
<p>Er zijn geen blogposts van deze auteur.</p>
@endif