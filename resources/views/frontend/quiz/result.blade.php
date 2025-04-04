@extends('frontend.master')

@section('home')


<style>
    .container-result {
        justify-self: center;
        align-self: center;
        text-align: center;
        margin:80px;
        padding:80px;
    }

    .container-result h2 {
        font-size: 50px;
    }

    .container-result p {
        font-size: 20px;
    }

    .container-result a {
        padding: 10px;
        font-weight: bold;
        margin: 0 20px;
        border-radius: 15px;
    }

    .btn-group {
        display: flex;
        justify-content: space-between;
        margin-top: 50px;
    }

</style>

    <div class="container-result">
        <h2 class="mb-3">Hasil Kuis</h2>
        <p class="mb-3 mt-3">Jawaban Benar: {{ $correct }}</p>
        <p class="mb-3 mt-3">Jawaban Salah: {{ $wrong }}</p>
        <p class="mb-3 mt-3">Skor: {{ $score }} dari {{ $total }}</p>
        <div class="btn-group">
            <a href="{{ route('index') }}" class="btn btn-primary">Back to home</a>
            <a href="javascript:void(0);" id="saveQuizBtn" class="btn btn-primary">Save the Quiz</a>
        </div>
    </div>

    <script>
        const saveQuizResult = async (courseId, score, correct, wrong) => {
            try {
                const response = await fetch('/quiz/result/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        course_id: courseId,
                        score: score,
                        correct_answers: correct,
                        wrong_answers: wrong,
                    }),
                });
    
                if (!response.ok) {
                    const text = await response.text();
                    console.error("Error response from server:", text);
                    toastr.error("Server error!");
                    return;
                }
    
                const data = await response.json(); 
                toastr.success(data.message);
            } catch (error) {
                toastr.error("Gagal menyimpan kuis!");
                console.error(error);
            }
        };

        document.addEventListener("DOMContentLoaded", function () {
            const btn = document.getElementById("saveQuizBtn");
            if (btn) {
                btn.addEventListener("click", function () {
                    saveQuizResult({{ $course->id }}, {{ $correct }}, {{ $wrong }}, {{ $score }});
                });
            } else {
                console.error("Tombol Save Quiz tidak ditemukan!");
            }
        });

    </script>

@endsection
