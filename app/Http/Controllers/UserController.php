<?php

namespace App\Http\Controllers;

use App\Models\WatchedMovie;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function cabinet(Request $request)
{
    $user = $request->user();
    $watchedMovies = WatchedMovie::where('user_id', $user->id)->get();

    return view('cabinet', compact('watchedMovies'));
}
}
