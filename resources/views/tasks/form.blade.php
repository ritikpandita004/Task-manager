<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $task->title ?? '') }}">
    @error('title') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $task->description ?? '') }}</textarea>
    @error('description') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-control">
        @foreach (['pending', 'in_progress', 'completed'] as $status)
            <option value="{{ $status }}"
                {{ old('status', $task->status ?? 'pending') === $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
    @error('status') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Due Date</label>
    <input type="date" name="due_date" class="form-control" value="{{ old('due_date', $task->due_date ?? '') }}">
    @error('due_date') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="d-flex justify-content-between">
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-lg w-20">Cancel</a>
    <button type="submit" class="btn btn-success btn-lg w-20">Save</button>
</div>

