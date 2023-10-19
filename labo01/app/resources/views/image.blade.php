@extends('main')

@section('pageContent')
<div id="main">
    <!-- Event table -->
        <section id="concert">
            <header class="major">
                <h2>{{ $image->title }}</h2>
            </header>
            <div class="table-wrapper">
                <div class="box alt">
                    <div class="row 50% uniform">
                        <div class="12u$"><span class="image fit"><img src="{{ url($image->path) }}" alt="" /></span></div>
                    </div>
                </div>
                <p><a href="{{ url()->previous() }}">Terug naar concert</a></p>
            </div>
        </section>
</div>
@endsection