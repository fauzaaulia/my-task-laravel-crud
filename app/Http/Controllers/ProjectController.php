<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
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

        $nama = $request['nama'];
        $tanggal_mulai = $request['tanggal_mulai'];
        $tanggal_target = $request['tanggal_target'];

        $project = new Project();
        $project->nama = $nama;
        $project->tanggal_mulai = $tanggal_mulai;
        $project->tanggal_target = $tanggal_target;
        $project->created_at = now();
        $project->save();

        return redirect('projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        $tasks = Task::where('project_id', $project['id'])->get();
        $tersedia = Task::where('project_id', $project['id'])->where('status', 'tersedia')->get();
        $dikerjakan = Task::where('project_id', $project['id'])->where('status', 'dikerjakan')->get();
        $selesai = Task::where('project_id', $project['id'])->where('status', 'selesai')->get();
        // dd($dikerjakan);
        return view('tasks.index', compact('project', 'tasks', 'tersedia', 'dikerjakan', 'selesai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);

        return view('projects.update', compact('project'));
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
        $project = Project::find($id);

        $validasi = $request->validate([
            'nama' => 'required|max:255',
            'tanggal_mulai' => 'required',
            'tanggal_target' => 'required',
        ]);

        $nama = $request['nama'];
        $tanggal_mulai = $request['tanggal_mulai'];
        $tanggal_target = $request['tanggal_target'];

        $project->nama = $nama;
        $project->tanggal_mulai = $tanggal_mulai;
        $project->tanggal_target = $tanggal_target;
        $project->updated_at = now();
        $project->save();

        return redirect('projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $task = DB::table('tasks')->where('project_id', $id)->delete();

        $project->delete();

        return redirect()->back();
    }
}
