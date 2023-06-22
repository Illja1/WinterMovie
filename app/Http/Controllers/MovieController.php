<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\WatchedMovie;

class MovieController extends Controller
{
    private $apiKey = 'dce380a1ba835ac610046a65eb4e29a1'; // Replace with your actual API key

    public function movie()
    {
        $movies = $this->getNowPlayingMovies();

        return view('welcome', compact('movies'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $movies = $this->searchMovies($query);


        return view('search', compact('movies', 'query'));
    }

    public function show(Request $request, $id)
    {
        $movie = $this->getMovieDetails($id);
        $trailer = $movie['videos']['results'][0] ?? null;
        $videos = $movie['videos']['results'] ?? [];
        $videoUrl = count($videos) > 0 ? 'https://www.youtube.com/watch?v=' . $videos[0]['key'] : '';
        $watched = $request->user()->hasWatchedMovie($id);

        return view('show', compact('movie', 'trailer', 'videoUrl', 'watched'));
    }

    public function watched(Request $request, $movieId)
    {
        $user = auth()->user();
        $movie = $this->getMovieDetails($movieId);
        $movieTitle = $movie['title'];
        $watchedMovie = new WatchedMovie();
        $watchedMovie->user_id = $user->id;
        $watchedMovie->movie_id = $movieId;
        $watchedMovie->title = $movieTitle; 
        $watchedMovie->save();

        // Redirect back or perform any desired action
        return redirect()->back()->with('success', 'Movie marked as watched.')->with('watchedMovie', $watchedMovie);
    }

    private function getNowPlayingMovies()
    {
        $response = Http::get('https://api.themoviedb.org/3/movie/now_playing', [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'page' => 1,
        ]);

        return $response->json()['results'] ?? [];
    }

    private function searchMovies($query)
    {
        $response = Http::get('https://api.themoviedb.org/3/search/movie', [
            'api_key' => $this->apiKey,
            'query' => $query,
        ]);

        return $response->json()['results'] ?? [];
    }

    private function searchCategory($query)
    {
        $response = Http::get('https://api.themoviedb.org/3/search/category', [
            'api_key' => $this->apiKey,
            'query' => $query,
        ]);

        return $response->json()['results'] ?? [];
    }

    private function getMovieDetails($id)
    {
        $response = Http::get("https://api.themoviedb.org/3/movie/{$id}", [
            'api_key' => $this->apiKey,
            'append_to_response' => 'credits,videos',
        ]);

        return $response->json();
    }
}

