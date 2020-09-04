@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>Showing category</h1>
            <a class="btn btn-danger pull-left " href="{{ route('categories.index') }}">Back</a>
        </div>

        <div class="jumbotron text-center">
            <h2>{{ $category->name }}</h2>
            <p>
                <strong>Briefing:</strong> {{ $category->briefing }}<br>
            </p>
        </div>

    </div>
@endsection
