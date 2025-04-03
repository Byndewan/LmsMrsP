@extends('instructor.instructor_dashboard')

@section('instructor')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Quiz</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('all.quiz',$course->id) }}" class="btn btn-primary px-5">Back</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Add Quiz</h5>
            <form id="quizForm" action="{{ route('store.quiz') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
            
                <div class="form-group mt-3">
                    <label class="form-label">Question Type</label>
                    <select name="question_type" id="question_type" class="form-select" required>
                        <option selected disabled>Select Type</option>
                        <option value="pg_text">Multiple Choice (Text)</option>
                        <option value="essay_text">Essay (Text)</option>
                        <option value="pg_audio">Multiple Choice (Audio)</option>
                        <option value="essay_audio">Essay (Audio)</option>
                    </select>
                </div>
            
                <div id="text_question" class="form-group mt-3 d-none">
                    <label class="form-label">Question (Text)</label>
                    <textarea name="question_text" class="form-control"></textarea>
                </div>
            
                <div id="audio_question" class="form-group mt-3 d-none">
                    <label class="form-label">Upload Question (Audio)</label>
                    <input type="file" name="audio" class="form-control" accept="audio/*">
                </div>
            
                <div id="mcq_options" class="form-group mt-3 d-none">
                    <label class="form-label">Options</label>
                    <div id="options_container">
                        <div class="d-flex mb-2">
                            <input type="text" name="options[]" class="form-control me-2" placeholder="Option 1">
                            <button type="button" class="btn btn-success add_option">+</button>
                        </div>
                    </div>
                </div>
            
                <div id="correct_answer" class="form-group mt-3 d-none">
                    <label class="form-label">Correct Answer</label>
                    <input type="text" name="answer" class="form-control">
                </div>
            
                <button type="submit" class="btn btn-primary mt-3">Save Quiz</button>
            </form>
            
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#question_type').change(function() {
        let type = $(this).val();
        $('#text_question, #audio_question, #mcq_options, #correct_answer').addClass('d-none');

        if (type.includes('text')) {
            $('#text_question').removeClass('d-none');
        }
        if (type.includes('audio')) {
            $('#audio_question').removeClass('d-none');
        }
        if (type.startsWith('pg')) {
            $('#mcq_options, #correct_answer').removeClass('d-none');
        }
        if (type.startsWith('essay')) {
            $('#correct_answer').removeClass('d-none');
        }
    });

    $(document).on('click', '.add_option', function() {
        $('#options_container').append('<div class="d-flex mb-2"><input type="text" name="options[]" class="form-control me-2" placeholder="Option"><button type="button" class="btn btn-danger remove_option">-</button></div>');
    });

    $(document).on('click', '.remove_option', function() {
        $(this).parent().remove();
    });
});
</script>

@endsection
