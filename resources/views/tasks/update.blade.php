@extends('layout')

@section('content')

<h1 class="my-4 text-center">Edit Task</h1>

<div class="row justify-content-center">
    <div class="col-6">

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

        <form method="post" action="{{ route('tasks.update', $task['id']) }}" >
            @method('put')
            @csrf
        <input type="text" class="form-control" name="id" value="{{ $task['id'] }}" hidden>
        <input type="text" class="form-control" name="project_id" value="{{ $task['project_id'] }}" hidden>
            <div class="form-group">
                <label for="nama"><b>Nama</b></label>
                <input value="{{ $task['nama'] }}" type="text" class="form-control" id="nama" name="nama" placeholder="Nama Task">
            </div>
            <div class="form-group">
                <label for="nama"><b>Keterangan</b></label>
                <textarea type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Singkat" rows="2">{{ $task['keterangan'] }}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="tanggal_mulai"><b>Tanggal Mulai</b></label>
                    <div class="input-group date">
                        <input value="{{ $task['tanggal_mulai'] }}" placeholder="Tanggal mulai" type="text" class="form-control datepicker" name="tanggal_mulai">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="tanggal_target"><b>Tanggal Target</b></label>
                    <div class="input-group date">
                        <input value="{{ $task['tanggal_target'] }}" placeholder="Target Selesai" type="text" class="form-control datepicker" name="tanggal_target">
                    </div>
                </div>
            </div>
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </form>
    </div>
</div>


@endsection
