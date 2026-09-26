<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 760px; margin: 40px auto; background:#f6f7fb; color:#1c1d21; }
        h1 { margin-bottom: 20px; }
        .btn { display:inline-block; padding:8px 14px; border-radius:6px; text-decoration:none; font-size:0.85rem; font-weight:600; border:none; cursor:pointer; }
        .btn-primary { background:#4f46e5; color:#fff; }
        .btn-edit { background:#e5e7eb; color:#1c1d21; }
        .btn-delete { background:#dc2626; color:#fff; }
        .alert { background:#dcfce7; color:#166534; padding:10px 14px; border-radius:8px; margin-bottom:16px; }
        table { width:100%; border-collapse:collapse; background:#fff; border-radius:10px; overflow:hidden; }
        th, td { text-align:left; padding:12px; border-bottom:1px solid #e5e7eb; font-size:0.9rem; }
        select { padding:4px 6px; border-radius:6px; border:1px solid #e5e7eb; }
        .actions { display:flex; gap:6px; }
        form.inline { display:inline; }
    </style>
</head>
<body>
    <h1>✅ Task Manager</h1>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <p><a class="btn btn-primary" href="{{ route('tasks.create') }}">+ Add Task</a></p>

    <table>
        <thead>
            <tr>
                <th>Task</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->task_name }}</td>
                    <td>{{ $task->due_date?->format('M d, Y') ?? '—' }}</td>
                    <td>
                        <form class="inline" method="POST" action="{{ route('tasks.status', $task) }}">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()">
                                @foreach (\App\Models\Task::STATUSES as $status)
                                    <option value="{{ $status }}" @selected($task->status === $status)>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td class="actions">
                        <a class="btn btn-edit" href="{{ route('tasks.edit', $task) }}">Edit</a>
                        <form class="inline" method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-delete" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No tasks yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
