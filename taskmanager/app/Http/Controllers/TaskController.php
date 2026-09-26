<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    // View Tasks
    public function index(): View
    {
        $tasks = Task::latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    // Show Add Task form
    public function create(): View
    {
        return view('tasks.create');
    }

    // Add Task
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task added.');
    }

    // Show Edit Task form
    public function edit(Task $task): View
    {
        return view('tasks.edit', compact('task'));
    }

    // Edit Task (update title/description)
    public function update(Request $request, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

    // Update Status only
    public function updateStatus(Request $request, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,in_progress,done'],
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Status updated.');
    }

    // Delete Task
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }
}
