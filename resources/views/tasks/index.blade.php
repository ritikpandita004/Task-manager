@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">My Tasks</h2>

        <!-- Show deleted tasks -->
        <a href="{{ route('tasks.index', ['trashed' => '1']) }}" class="btn btn-warning mb-3">Show Deleted Tasks</a>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary mb-3">Show All Tasks</a>

        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">+ New Task</a>



        <form method="GET" action="{{ route('tasks.index') }}" class="row mb-3">
            <div class="col-md-3">
                <input type="date" name="due_date" class="form-control" value="{{ request('due_date') }}"
                    placeholder="Filter by Due Date">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">-- Filter by Status --</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-outline-primary">Apply Filters</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ ucfirst($task->status) }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>
                            @if($task->trashed())
                                <!-- Restore deleted task -->
                                <form action="{{ route('tasks.restore', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Restore</button>
                                </form>
                            @else
                                <!-- Edit and delete tasks -->
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this task?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="4">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection