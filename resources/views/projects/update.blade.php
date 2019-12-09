@extends('layout')

@section('content')

<h1 class="my-4 text-center">Edit Project</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<a class="btn btn-outline-primary my-2" role="button" href="{{ url()->previous() }}">Kembali</a>

<div class="row justify-content-md-center">
    <div class="col-md-auto">
        <form method="post" action="{{ route('projects.update',$project['id']) }}" >
            @method('put')
            @csrf
            <div class="form-group">
                <label for="nama"><b>Nama</b></label>
            <input value="{{$project['nama']}}" type="text" class="form-control" id="nama" name="nama" placeholder="Nama Project">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="tanggal_mulai"><b>Tanggal Mulai</b></label>
                    <div class="input-group date">
                        <input value="{{$project['tanggal_mulai']}}" placeholder="Tanggal mulai" type="text" class="form-control datepicker" name="tanggal_mulai">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="tanggal_target"><b>Tanggal Target</b></label>
                    <div class="input-group date">
                        <input value="{{$project['tanggal_target']}}" placeholder="Target Selesai" type="text" class="form-control datepicker" name="tanggal_target">
                    </div>
                </div>
            </div>
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </form>
    </div>
</div>

@endsection
