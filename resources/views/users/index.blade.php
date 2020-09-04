@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>All Users</h1>
            <a class="btn btn-danger pull-left " href="{{ route('users.create') }}">Create new users</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Email</td>
                <td>Verified email</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>
                        @if($value->email_verified_at != null)
                            Yes
                        @else
                            No
                        @endif
                    </td>

                    <td>
                        {{ Form::open(array('route' => array('users.destroy', $value->id), 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete this user', array('class' => 'btn btn-warning')) }}
                        {{ Form::close() }}

                        <a class="btn btn-small btn-success" href="{{ route('users.show', $value->id ) }}">Show</a>

                        <a class="btn btn-small btn-info"
                           href="{{ route('users.edit', $value->id ) }}">Edit</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
