@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>Showing user</h1>
            <a class="btn btn-danger pull-left " href="{{ route('users.index') }}">Back</a>
        </div>

        <div class="jumbotron text-center">
            <h2>{{ $user->name }}</h2>
            <p>
                <strong>Email:</strong> {{ $user->email }}<br>
                <strong>Verified email:</strong>
                @if($user->email_verified_at != null)
                    {{'Yes'}}
                @else
                    {{'No'}}
                @endif
            </p>
        </div>

    </div>
@endsection
