@extends('layout')
@section('title', $category ." ".'Movies')
@section('content')
<link href="{{ asset('/css/style-category.css') }}" rel="stylesheet">
    <div class="movie-list">
        @foreach ($movies as $movie)
            <div class="movie">
                <a href="{{ route('movies.show', $movie['id']) }}">
                    <img src="https://image.tmdb.org/t/p/w300/{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }} Poster">
                    <h3>{{ $movie['title'] }}</h3>
                    <p>{{ $movie['overview'] }}</p>
                    <p>Release Date: {{ $movie['release_date'] }}</p>
                    <p>Genres: 
                        @foreach ($genres as $genre)
                            @if (in_array($genre['id'], $movie['genre_ids']))
                                {{ $genre['name'] }},
                            @endif
                        @endforeach
                    </p>
                </a>
            </div>
        @endforeach
    </div>
@endsection