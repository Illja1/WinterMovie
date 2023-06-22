<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class CategoryController extends Controller
{
    private $apiKey = 'dce380a1ba835ac610046a65eb4e29a1';

    public function moviesByCategory($category)
    {
        $genreId = $this->getGenreIdByCategory($category);
        if ($genreId === null) {
            abort(404);
        }

        $movies = $this->getMoviesByGenre($genreId);
        $genres = $this->getGenres();

        return view('category', compact('movies', 'genres', 'category'));
    }

    private function getGenreIdByCategory($category)
    {
        $categories = [
            'Action' => 28,
            'Comedy' => 35,
            'Drama' => 18,
            'Horror' => 27,
            'Thriller' => 53,
        ];

        return $categories[$category] ?? null;
    }

    public function getGenres()
    {
        $response = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
        ]);

        return $response->json()['genres'] ?? [];
    }

    private function getMoviesByGenre($genreId)
    {
        $response = Http::get('https://api.themoviedb.org/3/discover/movie', [
            'api_key' => $this->apiKey,
            'with_genres' => $genreId,
            'language' => 'en-US',
            'page' => 1,
        ]);

        return $response->json()['results'] ?? [];
    }
}
// class CategoryController extends Controller
// {
//     private $apiKey = 'dce380a1ba835ac610046a65eb4e29a1';

//     public function getMoviesByCategory($categoryName, $genreId)
//     {
//         $movies = $this->getMoviesByGenre($genreId);
//         $genres = $this->getGenres();

//         return view('category', compact('movies', 'genres', 'categoryName'));
//     }

//     public function actionMovies()
//     {
//         return $this->getMoviesByCategory('Action', 28);
//     }

//     public function comedyMovies()
//     {
//         return $this->getMoviesByCategory('Comedy', 35);
//     }

//     public function dramaMovies()
//     {
//         return $this->getMoviesByCategory('Drama', 18);
//     }

//     public function thrillerMovies()
//     {
//         return $this->getMoviesByCategory('Thriller', 53);
//     }

//     public function horrorMovies()
//     {
//         return $this->getMoviesByCategory('Horror', 27);
//     }

//     public function getGenres()
//     {
//         $response = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
//             'api_key' => $this->apiKey,
//             'language' => 'en-US',
//         ]);

//         return $response->json()['genres'] ?? [];
//     }

//     private function getMoviesByGenre($genreId)
//     {
//         $response = Http::get('https://api.themoviedb.org/3/discover/movie', [
//             'api_key' => $this->apiKey,
//             'with_genres' => $genreId,
//             'language' => 'en-US',
//             'page' => 1,
//         ]);

//         return $response->json()['results'] ?? [];
//     }
// }
