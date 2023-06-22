@extends('layout')
@section('title', 'WinterMovie')
@section('content')

<link href="{{ asset('/css/welcome.css') }}" rel="stylesheet">
<header>
    @if (!session()->has('visited'))
        <h1>Welcome to WinterMovie!</h1>
        @php
            session(['visited' => true]);
        @endphp
    @endif
</header>

<section id="movies">
    <h2>Discover the Latest Movies</h2>
    <p>Explore our vast collection of movies available for streaming.</p>
    <div class="movie-poster">
            @foreach (array_slice($movies, 0, 5) as $movie)
            <a href="{{ route('movies.show', $movie['id']) }}">
        <div class="poster-image">
            <img src="https://image.tmdb.org/t/p/w300/{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }} Poster">
        </div>
        <div class="poster-info">
            <h3>{{ $movie['title'] }}</h3>
            <p>{{ $movie['overview'] }}</p>
            <p>Release Date: {{ $movie['release_date'] }}</p>
        </div>
        @endforeach
    </a>
</div>
</section>
<section id="genres">
    <h2>Popular Genres</h2>
    <ul>
        <li><a href="{{ route('categories.movies', ['category' => 'Action']) }}">Action</a></li>
        <li><a href="{{ route('categories.movies', ['category' => 'Comedy']) }}">Comedy</a></li>
        <li><a href="{{ route('categories.movies', ['category' => 'Drama']) }}">Drama</a></li>
        <li><a href="{{ route('categories.movies', ['category' => 'Thriller']) }}">Thriller</a></li>
        <li><a href="{{ route('categories.movies', ['category' => 'Horror']) }}">Horror</a></li>
    </ul>
</section>
<section id="about">
    <h2>About WinterMovie</h2>
    <p>WinterMovie is a leading streaming platform offering a wide range of movies in various genres. Our mission is to provide an exceptional movie-watching experience to our users.</p>
</section>
@endsection