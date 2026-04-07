<?php

// app/Http/Controllers/TaskController.php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use App\Jobs\ProcessNewTaskAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller {
    public function index() {
        // Step 1: For evidence, change this to Task::where('user_id', auth()->id())->get(); to show lazy loading [cite: 200-201]
        // Step 3: Optimized version using eager loading: [cite: 212-214]
        $tasks = Task::with(['category', 'user'])->where('user_id', auth()->id())->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create() {
        $categories = Category::all(); // Create some default categories manually in your DB or Tinker
        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in progress,completed',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'required|exists:categories,id',
        ]);

        $task = Auth::user()->tasks()->create($validated);

        // Dispatch background job [cite: 246-247]
        ProcessNewTaskAlert::dispatch($task); 

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task) {
        abort_if($task->user_id !== auth()->id(), 403); // Backend restriction [cite: 143-144]
        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(Request $request, Task $task) {
        abort_if($task->user_id !== auth()->id(), 403);
        $task->update($request->all());
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task) {
        abort_if($task->user_id !== auth()->id(), 403); // Backend restriction [cite: 143-144]
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
