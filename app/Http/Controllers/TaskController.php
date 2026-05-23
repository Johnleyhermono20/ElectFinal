<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // 1. Display Workspace (Split Index View)
    public function index()
    {
        // Fetch tasks split cleanly by their status
        $pendingTasks = Task::with('category')->where('status', 'Pending')->orderBy('due_date', 'asc')->get();
        $completedTasks = Task::with('category')->where('status', 'Completed')->orderBy('updated_at', 'desc')->get();
        $categories = Category::all();

        return view('tasks.index', compact('pendingTasks', 'completedTasks', 'categories'));
    }

    // 2. Task Creation (CRUD) with Input Validation
    public function store(Request $request)
    {
        // Enforce input validation criteria
        $request->validate([
            'title' => 'required|string|max:255', // Title is required
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id', // Must be a valid category drop-down selection
            'due_date' => 'required|date|after_or_equal:today', // Enforce that dates are not set in the past
        ]);

        Task::create($request->all());

        // Flash success message for the user interface
        return redirect()->back()->with('success', 'Task created successfully!');
    }

    // 3. Toggle Task Status (Pending <-> Completed)
    public function toggleStatus(Task $task)
    {
        // Dynamically switch data between states using a single action
        $task->status = $task->status === 'Pending' ? 'Completed' : 'Pending';
        $task->save();

        return redirect()->back()->with('success', "Task marked as {$task->status}!");
    }

    // 4. Delete Action
    public function destroy(Task $task)
    {
        // Permanently delete a task from the system
        $task->delete();

        return redirect()->back()->with('success', 'Task permanently deleted!');
    }
}
