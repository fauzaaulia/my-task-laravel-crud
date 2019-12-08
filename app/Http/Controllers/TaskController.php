<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required|max:255',
            'tanggal_mulai' => 'required',
            'tanggal_target' => 'required',
        ]);

        $id = $request['id'];
        $nama = $request['nama'];
        $keterangan = $request['keterangan'];
        $tanggal_mulai = $request['tanggal_mulai'];
        $tanggal_target = $request['tanggal_target'];

        $task = new Task();
        $task->nama = $nama;
        $task->keterangan = $keterangan;
        $task->status = 'tersedia';
        $task->done = 0;
        $task->tanggal_mulai = $tanggal_mulai;
        $task->tanggal_target = $tanggal_target;
        $task->project_id = $id;
        $task->created_at = now();
        $task->save();

        return redirect()->route('projects.id', [$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        // dd($task);
        return view('tasks.update', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        $validasi = $request->validate([
            'nama' => 'required|max:255',
            'keterangan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_target' => 'required'
        ]);

        $project_id = $request['project_id'];

        $task->nama = $request['nama'];
        $task->keterangan = $request['keterangan'];
        $task->tanggal_mulai = $request['tanggal_mulai'];
        $task->tanggal_target = $request['tanggal_target'];
        $task->updated_at = now();
        $task->save();

        return redirect()->route('projects.id', [$project_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect()->back();
    }

    public function tersedia($id)
    {
        $task = Task::find($id);
        $task->status = 'tersedia';
        $task->tanggal_selesai = null;
        $task->done = 0;
        $task->updated_at = now();
        $task->save();

        return redirect()->back();
    }

    public function dikerjakan($id)
    {
        $task = Task::find($id);
        $task->status = 'dikerjakan';
        $task->tanggal_selesai = null;
        $task->done = 0;
        $task->updated_at = now();
        $task->save();

        return redirect()->back();
    }

    public function selesai($id)
    {
        $task = Task::find($id);
        $task->status = 'selesai';
        $task->tanggal_selesai = now();
        $task->done = 1;
        $task->updated_at = now();
        $task->save();

        return redirect()->back();
    }
}
