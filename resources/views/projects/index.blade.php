@extends('layout')

@section('content')
<h1 class="my-4">List Projects</h1>

    <div class="row justify-content-between">
        <div class="col-auto mr-auto">
            <a class="btn btn-outline-primary my-2" role="button" href="{{route('home')}}">Kembali</a>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary my-2" role="button" href="{{route('projects.create')}}">Tambah Project</a>
        </div>
    </div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr class="table-warning">
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Mulai</th>
            <th scope="col">Target</th>
            <th scope="col">Selesai</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
            <th scope="row">{{$loop->iteration}}</th>
                <td><b><a href="{{route('projects.show',$project['id'])}}">{{$project['nama']}}</a></b></td>
                <td>{{$project['tanggal_mulai']}}</td>
                <td>{{$project['tanggal_target']}}</td>
                <td>{{$project['tanggal_selesai']}}</td>
                <td>
                    <form action="{{route('projects.destroy',$project['id'])}}" method="post">
                        <a href="{{route('projects.edit', $project['id'])}}" role="button" class="btn btn-primary btn-sm">Edit</a>
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        @method('delete')
                        @csrf
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
