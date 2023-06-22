@extends('layout')
@section('title', $movie['title'])
@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container-fluid content-container">
    <div class="row">
        <div class="col-md-6">
            @if ($trailer)
                <div class="trailer">
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $trailer['key'] }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            @else
                <div class="poster">
                    <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }} Poster" width="100%">
                </div>
            @endif
        </div>
        <div class="col-md-6">
            <h2>{{ $movie['title'] }}</h2>
            <p class="overview">{{ $movie['overview'] }}</p>
            <h3>Actors</h3>
            <p class="actors">
                @php
                    $showAllActors = false;
                @endphp
                @foreach ($movie['credits']['cast'] as $index => $actor)
                    @if ($index < 10 || $showAllActors)
                        {{ $actor['name'] }}
                        @if ($index < count($movie['credits']['cast']) - 1)
                            ,
                        @endif
                    @endif
                @endforeach
            </p>
            @if (count($movie['credits']['cast']) > 10)
                <button type="button" class="btn btn-link" onclick="toggleActors()">Show {{ $showAllActors ? 'Less' : 'More' }}</button>
            @endif
            <h3>Film Details</h3>
            <p><strong>Release Date:</strong> {{ $movie['release_date'] }}</p>
            <p><strong>Runtime:</strong> {{ $movie['runtime'] }} minutes</p>
            <p><strong>Genres:</strong>
                @foreach ($movie['genres'] as $index => $genre)
                    {{ $genre['name'] }}
                    @if ($index < count($movie['genres']) - 1)
                        ,
                    @endif
                @endforeach
            </p>
        </div>
    </div>
</div>

@if (!$watched)
    <form action="/movies/{{ $movie['id'] }}" method="POST">
        @csrf
        @method('POST')
        <button type="submit" class="btn btn-primary">Mark as Watched</button>
    </form>
@endif

<div class="spacer"></div>

<div id="video-player" class="video-center">
<video controls style="width: 100%;">

        <source src="{{ $videoUrl }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<style>
    .actors:not(.show-all) {
        max-height: 100px;
        overflow: hidden;
    }
    .btn-link {
        padding: 0;
    }
    .spacer {
        height: 50px; /* Adjust the value to set the desired space */
    }

    /* Add spacing between navbar and content */
    .content-container {
        margin-top: 20px;
    }

    #video-player{
    width: 100%;
    text-align: center;
    }

    /* Add spacing between content and footer */
    footer {
        margin-top: 50px;
    }
</style>

<script>
    function toggleActors() {
        const actorsElement = document.querySelector('.actors');
        actorsElement.classList.toggle('show-all');
        const showButton = document.querySelector('.btn-link');
        showButton.textContent = actorsElement.classList.contains('show-all') ? 'Show Less' : 'Show More';
    }
</script>
@endsection
