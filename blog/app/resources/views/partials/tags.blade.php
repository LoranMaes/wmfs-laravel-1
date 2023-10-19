<div class="mb-4">
    @if (sizeof($post->tags) > 0)
    @foreach($post->tags as $tag)
    <span class="badge badge-pill badge-info">{{ $tag->title }}</span>
    @endforeach
    @endif
</div>