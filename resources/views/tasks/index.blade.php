@extends('layout')

@section('content')
<h1 class="my-4">Project : {{$project['nama']}} </h1>

<a class="btn btn-outline-danger my-2" role="button" href="{{route('projects.index')}}">Kembali</a>

<hr>

<div class="card">
    <h4 class="card-header text-white bg-dark">Task</h4>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="card ">
                    <h5 class="card-header text-white bg-primary">Tersedia</h5>
                    <div class="card-body">
                        @if (count($tersedia) > 0)
                            @foreach ($tersedia as $ada)
                                <a style="color:black" href="#">{{$ada['nama']}}</a>
                                <a href="{{ route('tasks.dikerjakan',$ada['id']) }}" class="badge badge-info float-right">></a>
                                <hr>
                            @endforeach
                        @else
                            <p class="text-center">Tidak ada data</p>
                        @endif
                    </div>
                    <div class="card-footer">
                        <!-- Button trigger modal tambah task -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahTask">
                                Tambah Task
                        </button>
                        {{-- <a class="btn btn-primary my-2" role="button" href="{{ route('tasks.create') }}">Tambah Task</a> --}}
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <h5 class="card-header text-white bg-warning">Dikerjakan</h5>
                    <div class="card-body">
                        @if (count($dikerjakan) > 0)
                            @foreach ($dikerjakan as $kerja)
                                <a style="color:black" href="#">{{$kerja['nama']}}</a>
                                <a href="{{ route('tasks.selesai',$kerja['id']) }}" class="badge ml-1 badge-info float-right">></a>
                                <a href="{{ route('tasks.tersedia',$kerja['id']) }}" class="badge badge-info float-right"><</a>
                                <hr>
                            @endforeach
                            @else
                            <p class="text-center">Tidak ada data</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <h5 class="card-header text-white bg-success">Selesai</h5>
                    <div class="card-body">
                        @if (count($selesai) > 0)
                            @foreach ($selesai as $bar)
                                <a style="color:black" href="#">{{ $bar['nama'] }}</a>
                                <a href="{{ route('tasks.dikerjakan',$bar['id']) }}" class="badge badge-info float-right"><</a>
                                <hr>
                            @endforeach
                        @else
                            <p class="text-center">Tidak ada data</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

    <table class="table table-hover">
        <thead>
            <tr class="table-warning">
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Tgl Mulai</th>
            <th scope="col">Tgl Target</th>
            <th scope="col">Tgl Selesai</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($tasks) > 0)
            @foreach ($tasks as $task)
            <tr>
            <th scope="row">{{$loop->iteration}}</th>
                <td><b><a href="{{route('tasks.show',$task['id'])}}">{{$task['nama']}}</a></b></td>
                <td>{{$task['keterangan']}}</td>
                <td>{{$task['tanggal_mulai']}}</td>
                <td>{{$task['tanggal_target']}}</td>
                <td>{{$task['tanggal_selesai']}}</td>
                <td>
                    <a href="{{route('tasks.edit', $task['id'])}}" role="button" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{route('tasks.destroy',$task['id'])}}" method="post">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        @method('delete')
                        @csrf
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr bgcolor="#fff">
                <td align="center" colspan="7">Tidak ada data!</td>
            </tr>
            @endif


        </tbody>
    </table>



<!-- Modal -->
<div class="modal fade" id="tambahTask" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="tambahTaskLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahTaskLabel">Tambah Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('tasks.store') }}" >
                    @csrf
                    <input type="text" class="form-control" name="id" value="{{$project['id']}}" hidden>
                    {{-- {!! Form::text('project_id', {{$project['id']}}) !!} --}}
                    <div class="form-group">
                        <label for="nama"><b>Nama</b></label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Task">
                    </div>
                    <div class="form-group">
                        <label for="nama"><b>Keterangan</b></label>
                        <textarea type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Singkat" rows="2"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tanggal_mulai"><b>Tanggal Mulai</b></label>
                            <div class="input-group date">
                                <input placeholder="Tanggal mulai" type="text" class="form-control datepicker" name="tanggal_mulai">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tanggal_target"><b>Tanggal Target</b></label>
                            <div class="input-group date">
                                <input placeholder="Target Selesai" type="text" class="form-control datepicker" name="tanggal_target">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
