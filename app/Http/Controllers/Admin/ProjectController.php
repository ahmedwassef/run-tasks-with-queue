<?php

namespace App\Http\Controllers\Admin;



use App\Events\CountUpdated;
use App\Helpers\Task;
use App\Http\Controllers\Controller;
use App\Jobs\FileCounter;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Traits\ArtisanCommands;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class ProjectController extends Controller
{
    use ArtisanCommands;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */


    public function index()
    {


        $projects = Project::orderBy('id', 'desc')
            ->with(['taskCharacters', 'taskLines', 'taskWords'])
            ->withCount(['taskCharacters', 'taskLines', 'taskWords'])
            ->paginate(5);

        return Inertia::render('Project/Index', [
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Project/Create', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:6', 'max:6'],
            'file' => ['required'],
            'task_type' => ['required', 'string'],
        ]);

        $projectData = [];
        $projectData['name'] = strtoupper('PRJ_' . $request->name);
        $projectData['uuid'] = \Str::uuid()->toString();

        $project = Project::firstOrCreate(['name' => 'PRJ_' . $request->name], $projectData);

        $task =  Task::createTask($request,$project);

        Task::batchTaskJobs($task);

        return Redirect::route('dashboard.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $project = Project::where('uuid', $uuid)->firstOrFail();
        $tasks = ProjectTask::where('project_id', $project->id)->latest()->paginate(5);

        return Inertia::render('Project/Show', [
            'project' => $project,
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
