<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = Task::with('project:id,name');
        $query->select('id', 'name', 'project_id', 'priority', 'description');
        $query->when($request->project_ids, function ($query) use ($request) {
            $query->whereIn('project_id', explode(',', $request->project_ids));
        });
        $query->when($request->search, function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%");
                $query->orWhere('description', 'like', "%{$request->search}%");
                $query->orWhere('priority', $request->search);
                $query->orWhereHas('project', function ($query) use ($request) {
                    $query->where('name', 'like', "%{$request->search}%");
                });
            });
        });
        $query->orderBy('priority', 'asc');
        $tasks = $query->paginate(10)->withQueryString();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task Created Successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $task->deleteOrFail();
        return redirect()->back()->with('success', 'Task Deleted Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePriority(Request $request)
    {
        $taskIds = explode(',', $request->updatedTasks);
        $priorities = json_decode($request->priorities);

        $cases = [];
        $ids = [];
        $params = [];

        foreach ($taskIds as $index => $id) {
            $cases[] = "WHEN {$id} then ?";
            $params[] = $priorities[$index];
            $ids[] = $id;
        }

        $ids = implode(',', $ids);
        $cases = implode(' ', $cases);

        if (!empty($ids)) {
            DB::update("UPDATE tasks SET `priority` = CASE `id` {$cases} END WHERE `id` in ({$ids})", $params);
        }
        return redirect()->back()->with('success', 'Priorities Updated Successfully!');
    }
}
