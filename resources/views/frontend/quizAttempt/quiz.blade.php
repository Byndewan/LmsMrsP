@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
    <style>
        .score {
            font-size: 24px;
            color: #339999;
            font-weight: bold;
        }
        .question {
            margin-top: 15px;
            text-align: left;
            padding: 15px;
            border-radius: 8px;
        }
        .incorrect {
            background: #fde8e8;
            border-left: 5px solid #e74c3c;
        }
        .correct {
            background: #e6f9e6;
            border-left: 5px solid #2ecc71;
        }
        .answer {
            font-weight: bold;
        }
        .explanation {
            font-size: 14px;
            color: #555;
            margin-top: 10px;
        }
        .text-play {
            display: flex;
            justify-content: start;
            font-weight: bold;
        }
    </style>
<div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">My Quiz Result</h3>
            <p class="score">{{ $quizResult->score }}/{{ $quizResult->wrong_answers * 10 + $quizResult->correct_answers * 20 }}</p>
        </div>


        <div class="question correct">
            <p><strong>What is the meaning of "Je m'appelle Julia"?</strong></p>
            <p class="answer" style="color: green;">✅ Your Answer: My name is Julia</p>
            <p class="explanation">📚 Explanation: "Je m'appelle Julia" means "My name is Julia" because it literally translates to "I call myself Julia," which is how French speakers introduce themselves.</p>
        </div>
        
        <div class="question incorrect mb-3">
            <p><strong>What is the meaning of "Je m'appelle Julia"?</strong></p>
            <p class="answer" style="color: red;">❌ Your Answer: She is eating pizza</p>
            <p class="answer" style="color: green;">✔ Right Answer: My name is Julia</p>
            <p class="explanation">📚 Explanation: "Je m'appelle Julia" means "My name is Julia" because it literally translates to "I call myself Julia," which is how French speakers introduce themselves.</p>
        </div>

</div>

@endsection