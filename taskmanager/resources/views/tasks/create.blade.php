<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Task</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 500px; margin: 40px auto; background:#f6f7fb; color:#1c1d21; }
        form { background:#fff; padding:20px; border-radius:10px; display:flex; flex-direction:column; gap:12px; }
        label { font-size:0.85rem; font-weight:600; }
        input, textarea { padding:10px; border-radius:6px; border:1px solid #e5e7eb; font-size:0.9rem; }
        .btn { padding:10px 16px; border-radius:6px; border:none; background:#4f46e5; color:#fff; font-weight:600; cursor:pointer; }
        .error { color:#dc2626; font-size:0.8rem; }
        a { color:#4f46e5; text-decoration:none; font-size:0.85rem; }
    </style>
</head>
<body>
    <h1>Add Task</h1>

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div>
            <label>Task Name</label>
            <input type="text" name="task_name" value="{{ old('task_name') }}" required maxlength="255">
            @error('task_name') <div class="error">{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Description</label>
            <textarea name="description" rows="4">{{ old('description') }}</textarea>
        </div>
        <div>
            <label>Due Date</label>
            <input type="date" name="due_date" value="{{ old('due_date') }}">
            @error('due_date') <div class="error">{{ $message }}</div> @enderror
        </div>
        <button class="btn" type="submit">Add Task</button>
    </form>

    <p><a href="{{ route('tasks.index') }}">&larr; Back to tasks</a></p>
</body>
</html>
