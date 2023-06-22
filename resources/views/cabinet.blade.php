@extends('layout')
@section('title', 'User Cabinet')
@section('content')
    <h1>User Cabinet</h1>
    <h2>Watched Movies</h2>
    <div class="watched-movies">
        @if ($watchedMovies->isEmpty())
            <p>No watched movies yet.</p>
        @else
            <ul>
                @foreach ($watchedMovies as $watchedMovie)
                    <li>
                        <div class="movie-title">{{ $watchedMovie->title }}</div>
                        <div class="watched-at">Watched at: {{ $watchedMovie->created_at }}</div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
<style>
    /* user-cabinet.css */

.watched-movies {
  margin-top: 20px;
}

.movie-title {
  font-weight: bold;
}

.watched-at {
  color: #888;
  font-size: 0.9em;
  margin-top: 5px;
}
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

.container {
    min-height: 100%;
    display: flex;
    flex-direction: column;
}

.content {
    flex: 1;
}

.footer {
    background-color: #f5f5f5;
    padding: 10px;
    text-align: center;
}
</style>
