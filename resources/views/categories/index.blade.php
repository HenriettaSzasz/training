@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>All Categories</h1>
            <a class="btn btn-danger pull-left " href="{{ route('categories.create') }}">Create new categories</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Briefing</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->briefing }}</td>

                    <td>
                        {{ Form::open(array('route' => array('categories.destroy', $value->id), 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete this category', array('class' => 'btn btn-warning')) }}
                        {{ Form::close() }}

                        <a class="btn btn-small btn-success" href="{{ route('categories.show', $value->id ) }}">Show</a>

                        <a class="btn btn-small btn-info"
                           href="{{ route('categories.edit', $value->id ) }}">Edit</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
