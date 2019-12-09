@extends('layout')

@section('content')

<h1 class="my-4 text-center">Create Project</h1>

<div class="row justify-content-md-center">
    <div class="col-md-auto">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

        <a class="btn btn-outline-primary my-2" role="button" href="{{route('projects.index')}}">Kembali</a>

        <form method="post" action="{{route('projects.store')}}" >
            @csrf
            <div class="form-group">
                <label for="nama"><b>Nama</b></label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Project">
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
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </form>
    </div>
</div>

@endsection
