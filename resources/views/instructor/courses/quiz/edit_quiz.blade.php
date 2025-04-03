@extends('instructor.instructor_dashboard')

@section('instructor')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Quiz</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Edit Quiz</h5>
            <form action="{{ route('update.quiz', $quiz->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <select name="type" id="type" class="form-select mt-3">
                    <option value="pg_text" {{ $quiz->type == 'pg_text' ? 'selected' : '' }}>Multiple Choice (Text)</option>
                    <option value="essay_text" {{ $quiz->type == 'essay_text' ? 'selected' : '' }}>Essay (Text)</option>
                    <option value="pg_audio" {{ $quiz->type == 'pg_audio' ? 'selected' : '' }}>Multiple Choice (Audio)</option>
                    <option value="essay_audio" {{ $quiz->type == 'essay_audio' ? 'selected' : '' }}>Essay (Audio)</option>
                </select>
                
                <!-- Input untuk pertanyaan teks -->
                <div id="text_question" class="{{ in_array($quiz->type, ['pg_text', 'essay_text']) ? '' : 'd-none' }}">
                    <label class="mt-3">Question (Text)</label>
                    <textarea name="question" class="form-control">{{ $quiz->question }}</textarea>
                </div>
                
                <!-- Input untuk pertanyaan audio -->
                <div id="audio_question" class="{{ in_array($quiz->type, ['pg_audio', 'essay_audio']) ? '' : 'd-none' }}">
                    <label class="mt-3">Upload Question (Audio)</label>
                    <input type="file" name="audio" class="form-control" accept="audio/*">
                    @if($quiz->audio_path)
                        <p>Current Audio: <a href="{{ asset($quiz->audio_path) }}" target="_blank">Listen</a></p>
                    @endif
                </div>
                
                <!-- Input untuk Multiple Choice Options -->
                <div id="mcq_options" class="{{ in_array($quiz->type, ['pg_text', 'pg_audio']) ? '' : 'd-none' }}">
                    <label class="mt-3">Options</label>
                    <div id="options_container">
                        @foreach(json_decode($quiz->options, true) ?? [] as $index => $option)
                            <div class="d-flex mb-2">
                                <input type="text" name="options[]" class="form-control me-2" value="{{ $option }}" placeholder="Option {{ $index + 1 }}">
                                <button type="button" class="btn btn-danger remove_option">-</button>
                            </div>
                        @endforeach
                        <button type="button" class="btn btn-success add_option">+ Add Option</button>
                    </div>
                </div>
                
                <!-- Input untuk jawaban benar -->
                <div id="correct_answer" class="{{ $quiz->type != 'essay_audio' ? '' : 'd-none' }}">
                    <label class="mt-3">Correct Answer</label>
                    <input type="text" name="correct_answer" class="form-control" value="{{ $quiz->correct_answer }}">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Update Quiz</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        function toggleFields() {
            let type = document.getElementById("type").value;
            document.getElementById("text_question").classList.toggle("d-none", !type.includes("text"));
            document.getElementById("audio_question").classList.toggle("d-none", !type.includes("audio"));
            document.getElementById("mcq_options").classList.toggle("d-none", !type.startsWith("pg"));
            document.getElementById("correct_answer").classList.toggle("d-none", !type.startsWith("essay_audio"));
        }
    
        document.getElementById("type").addEventListener("change", toggleFields);
        toggleFields();
    
        document.querySelector(".add_option").addEventListener("click", function () {
            let container = document.getElementById("options_container");
            let div = document.createElement("div");
            div.classList.add("d-flex", "mb-2");
            div.innerHTML = `<input type="text" name="options[]" class="form-control me-2" placeholder="Option">
                             <button type="button" class="btn btn-danger remove_option">-</button>`;
            container.insertBefore(div, this);
        });
    
        document.addEventListener("click", function (event) {
            if (event.target.classList.contains("remove_option")) {
                event.target.parentElement.remove();
            }
        });
    });
</script>
    

@endsection
