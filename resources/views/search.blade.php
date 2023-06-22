@extends('layout')
@section('title', 'Search Results for ' . $query)
@section('content')
    <h2>Search Results</h2>

    <div class="movie-grid">
        @if (count($movies) > 0)
            @foreach ($movies as $movie)
                <div class="movie">
                    <a href="{{ route('movies.show', $movie['id']) }}">
                    <img src="https://image.tmdb.org/t/p/w300/{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }} Poster">
                    <h3>{{ $movie['title'] }}</h3>
                    <p>{{ $movie['overview'] }}</p>
                </div>
            @endforeach
        @else
            <p>No movies found.</p>
        @endif
    </div>

    <style>
        .movie-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .movie {
            flex-basis: 33.33%;
            max-width: 300px;
            margin: 10px;
        }

        .movie img {
            width: 100%;
            height: auto;
        }

        .movie h3 {
            margin: 10px 0;
            font-size: 18px;
        }

        .movie p {
            margin: 0;
            font-size: 14px;
        }
    </style>
@endsection
