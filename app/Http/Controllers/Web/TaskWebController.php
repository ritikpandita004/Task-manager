<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
class TaskWebController extends Controller
{
    // list of tasks
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', auth()->id());

        if ($request->has('trashed') && $request->trashed === '1') {
            $tasks = $tasks->onlyTrashed();
        }

        if ($request->filled('status')) {
            $tasks->where('status', $request->status);
        }

        if ($request->filled('due_date')) {
            $tasks->whereDate('due_date', $request->due_date);
        }

        $tasks = $tasks->get();

        return view('tasks.index', compact('tasks'));
    }


    // creating a new task
    public function create()
    {
        return view('tasks.create');
    }
    // store the task
    public function store(StoreTaskRequest $request)
    {
        $task = $request->user()->tasks()->create($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
    //form for editing a specific task
    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }
    // Update  the task 
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
    // Soft delete the task
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }


    // Restore the soft deleted task
    public function restore($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();

        return redirect()->route('tasks.index')->with('success', 'Task restored successfully!');
    }
}