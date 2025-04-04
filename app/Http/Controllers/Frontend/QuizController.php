<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\QuizResult;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function quizShow(){
        $quizResult = QuizResult::first();

        return view('frontend.quizAttempt.quiz',compact('quizResult'));
    }
}
