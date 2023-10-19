@extends('main')

@section('pageContent')
<div id="main">
    <!-- Event table -->
        <section id="event_table">
            <header class="major">
                <h2>Overzicht concerten</h2>
            </header>
            <form method="get" action="{{ url('/concerts') }}">
                <div class="row uniform 50%">
                    <div class="6u 12u$(xsmall)"></div>
                    <div class="3u 12u$(xsmall)">
                        <input type="text" name="search" id="search" value="{{ $searchString }}" placeholder="Zoekterm" />
                    </div>
                    <div class="3u 12u$(xsmall)">
                        <input type="submit" value="Zoeken" class="special fit small" style="height: 3.4em"/>
                    </div>
                </div>
            </form>
            @if ($companies)
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Naam en locatie</th>
                            <th>Prijs</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)    
                        <tr>
                            <td>{{ $company->id }} - {{ explode(' ', $company->start_date)[1] }}</td>
                            <td><a href="{{ url('concerts/' . $company->id) }}">{{ $company->title }} ({{ $company->location }}) @if ($company->fav == 1) </a> <a class="icon fa-star"></a> @endif<br/>
                                <form method="post" action="{{ url('/concerts/'.$company->id.'/toggle') }}" style="margin: 0">
                                    @csrf
                                    <input type="submit" @if ($company->fav == 0) value="voeg toe aan favorieten" @else value="verwijder uit favorieten" @endif class="small" style="line-height:0em; height: 2em"/>
                                </form>
                            </td>
                            <td>{{ $company->price }} &euro;</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>Geen concerten gevonden</p>
            @endif
        </section>
</div>
@endsection