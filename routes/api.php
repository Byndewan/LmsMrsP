<?php

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/courses/search', function (Request $request) {
    $query = $request->query('q');

    if (!$query || empty($query)) {
        return response()->json([]);
    }

    $courses = Course::where('course_name', 'LIKE', "%{$query}%")
                    ->orWhere('course_title', 'LIKE', "%{$query}%")
                    ->where('status', 1)
                    ->latest()
                    ->get();

    return response()->json($courses);
});
