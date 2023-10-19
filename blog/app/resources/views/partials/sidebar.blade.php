<div class="col-md-4">
    <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-light rounded">
            <h4 class="fst-italic">About</h4>
            <p class="mb-0">Before you criticize someone, you should walk a mile in their shoes. That way when
                you criticize them, you are a mile away from them and you have their shoes.</p>
        </div>

        <div class="p-4">
            <h4 class="fst-italic">Most recent</h4>
            <ol class="list-unstyled mb-0">
                @foreach ($recent_posts as $id => $value)
                <li><a href="{{ url('/blogposts/' . $id) }}">{{ $value }}</a></li>
                @endforeach
            </ol>
        </div>

    </div>
</div>