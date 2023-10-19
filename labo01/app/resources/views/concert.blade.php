@extends('main')

@section('pageContent')
<div id="main">
    <!-- Event table -->
        <section id="concert">
            <header class="major">
                <h2>{{ $company->title }}</h2>
            </header>
            <div class="table-wrapper">
                <table>
                    <tbody>
                        <tr>
                            <th>Datum</th>
                            <td>{{ (new Carbon\Carbon($company->start_date))->format('d M Y - H\\ui') }}</td>
                        </tr>
                        <tr>
                            <th>Locatie</th>
                            <td>{{ $company->location }}</td>
                        </tr>
                        <tr>
                            <th>Prijs</th>
                            <td>
                                {{ $company->price }} &euro;
                            </td>
                        </tr>
                    </tbody>
                </table>
                 
                <div class="box alt">
                    <div class="row 50% uniform">
                        @foreach ($images as $image)
                            <div class="4u"><a href="{{ url('concerts/' . $image->concert_id . '/images/' . $image->id) }}" class="image fit thumb"><img src="{{ url('images/' . explode('/', $image->path)[1]) }}" alt="" /></a></div>
                        @endforeach
                    </div>
                </div>
                <p><a href="{{ url('concerts') }}">Terug naar overzicht</a></p>
            </div>
        </section>
</div>
@endsection