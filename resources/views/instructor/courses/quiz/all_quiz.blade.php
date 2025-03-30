@extends('instructor.instructor_dashboard')

@section('instructor')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Quiz</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.quiz',$course->id) }}" class="btn btn-primary px-5">Add Quiz</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Quiz</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quizzes as $key => $quiz)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $quiz->question }}</td>
                                <td>
                                    @if ($quiz->type == 'pg_text')
                                        <span class="btn btn-primary btn-sm">Pilihan Ganda Text</span>
                                    @elseif ($quiz->type == 'essay_text')
                                        <span class="btn btn-primary btn-sm">Essay Text</span>
                                    @elseif ($quiz->type == 'pg_audio')
                                        <span class="btn btn-primary btn-sm">Pilihan Ganda Audio</span>
                                    @elseif ($quiz->type == 'essay_audio')
                                        <span class="btn btn-primary btn-sm">Essay Audio</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('edit.quiz', $quiz->id) }}" class="btn btn-info" title="Edit">
                                        <i class="lni lni-pencil"></i>
                                    </a>
                                    <a href="{{ route('delete.quiz', $quiz->id) }}" class="btn btn-danger" title="Delete" id="delete">
                                        <i class="lni lni-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
