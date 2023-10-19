<h3>Comments</h3>
@if ($comments->count() > 0)
@foreach ($comments as $comment)
<p><strong>{{ $comment->author->first_name }} {{ $comment->author->last_name }}</strong> &bullet; <em>{{
        $comment->created_at }}</em> &bullet; {{
    $comment->content }}</p>
@endforeach
@else
<p><strong>No comments were found :&lbbrk;</strong></p>
@endif