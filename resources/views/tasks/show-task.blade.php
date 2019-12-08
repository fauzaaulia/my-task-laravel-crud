@extends('layout')

@section('content')
<h1 class="mt-4">Task : {{$task['nama']}} </h1>
<h3 class="mb-4">Project_id : {{$task['project_id']}} </h3>

<a class="btn btn-outline-danger my-2" role="button" href="{{route('projects.id', $task['project_id'])}}">Kembali</a>

<hr>

<h5 class="text center"><b><i>cooming-soon</i></b></h5>
@endsection
