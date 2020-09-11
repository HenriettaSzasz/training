{{ Form::open(array('route' => array('categories.destroy', $id), 'class' => 'pull-right')) }}
@csrf
{{ Form::hidden('_method', 'DELETE') }}
{{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
{{ Form::close() }}

<a class="btn btn-small btn-success" href="{{ route('categories.show', $id ) }}">Show</a>

<a class="btn btn-small btn-info"
   href="{{ route('categories.edit', $id ) }}">Edit</a>
