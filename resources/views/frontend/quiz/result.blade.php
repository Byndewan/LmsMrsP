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
    }

    

</style>

    <div class="container-result">
        <h2 class="mb-3">Hasil Kuis</h2>
        <p class="mb-3 mt-3">Skor Anda: {{ $score }} dari {{ $total }}</p>
        <a href="{{ route('index') }}" class="btn btn-primary">Back to home</a>
    </div>
@endsection
