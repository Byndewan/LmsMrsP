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
        <h2 class="mb-3">Finish The Payment</h2>
        <div class="btn-group">
            <a href="{{ route('index') }}" class="btn btn-primary">Back to Home</a>
        </div>
    </div>

@endsection