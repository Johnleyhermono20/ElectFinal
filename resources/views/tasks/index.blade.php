<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }
        
        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .alerts {
            margin-bottom: 20px;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .form-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        
        input, textarea, select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s;
        }
        
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #667eea;
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
        }
        
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background-color: #667eea;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #5568d3;
            transform: translateY(-2px);
        }
        
        .btn-success {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            font-size: 0.9em;
        }
        
        .btn-success:hover {
            background-color: #218838;
        }
        
        .btn-danger {
            background-color: #dc3545;
            color: white;
            padding: 8px 15px;
            font-size: 0.9em;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
        }
        
        .tasks-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .tasks-column {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .tasks-column h2 {
            margin-bottom: 20px;
            color: #333;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }
        
        .task-item {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            border-left: 4px solid #667eea;
            transition: all 0.3s;
        }
        
        .task-item.completed {
            opacity: 0.7;
            border-left-color: #28a745;
            background-color: #e8f5e9;
        }
        
        .task-item:hover {
            transform: translateX(5px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .task-title {
            font-weight: 600;
            color: #333;
            font-size: 1.1em;
            margin-bottom: 5px;
        }
        
        .task-item.completed .task-title {
            text-decoration: line-through;
            color: #666;
        }
        
        .task-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 0.9em;
            color: #666;
            margin-bottom: 10px;
        }
        
        .task-category {
            display: inline-block;
            background-color: #667eea;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85em;
        }
        
        .task-due-date {
            display: inline-block;
        }
        
        .task-overdue {
            color: #dc3545;
            font-weight: 600;
        }
        
        .task-description {
            color: #666;
            margin-bottom: 10px;
            font-size: 0.95em;
        }
        
        .task-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .task-actions form {
            display: inline;
        }
        
        .empty-state {
            text-align: center;
            color: #999;
            padding: 40px 20px;
        }
        
        .empty-state p {
            font-size: 1.1em;
        }
        
        @media (max-width: 768px) {
            .tasks-section {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Task Management System</h1>
            <p>Stay organized and track your daily objectives</p>
        </div>
        
        <!-- Success Messages -->
        @if ($message = Session::get('success'))
            <div class="alerts">
                <div class="alert">{{ $message }}</div>
            </div>
        @endif
        
        <!-- Create Task Form -->
        <div class="form-card">
            <h3 style="margin-bottom: 20px; color: #333;">Create New Task</h3>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="title">Task Title *</label>
                        <input type="text" id="title" name="title" required placeholder="Enter task title">
                        @error('title')
                            <span style="color: #dc3545; font-size: 0.9em;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="category_id">Category *</label>
                        <select id="category_id" name="category_id" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span style="color: #dc3545; font-size: 0.9em;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="due_date">Due Date *</label>
                        <input type="date" id="due_date" name="due_date" required>
                        @error('due_date')
                            <span style="color: #dc3545; font-size: 0.9em;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Enter task description (optional)"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Create Task</button>
            </form>
        </div>
        
        <!-- Tasks Workspace -->
        <div class="tasks-section">
            <!-- Pending Tasks -->
            <div class="tasks-column">
                <h2>⏳ Pending Tasks ({{ $pendingTasks->count() }})</h2>
                
                @if($pendingTasks->count() > 0)
                    @foreach($pendingTasks as $task)
                        <div class="task-item">
                            <div class="task-title">{{ $task->title }}</div>
                            
                            @if($task->description)
                                <div class="task-description">{{ $task->description }}</div>
                            @endif
                            
                            <div class="task-meta">
                                <span class="task-category">{{ $task->category->name }}</span>
                                <span class="task-due-date @if(\Carbon\Carbon::parse($task->due_date)->isPast()) task-overdue @endif">
                                    📅 {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                    @if(\Carbon\Carbon::parse($task->due_date)->isPast())
                                        <strong>(OVERDUE)</strong>
                                    @endif
                                </span>
                            </div>
                            
                            <div class="task-actions">
                                <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">✓ Mark Complete</button>
                                </form>
                                
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">🗑️ Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <p>🎉 No pending tasks! Great job!</p>
                    </div>
                @endif
            </div>
            
            <!-- Completed Tasks -->
            <div class="tasks-column">
                <h2>✅ Completed Tasks ({{ $completedTasks->count() }})</h2>
                
                @if($completedTasks->count() > 0)
                    @foreach($completedTasks as $task)
                        <div class="task-item completed">
                            <div class="task-title">{{ $task->title }}</div>
                            
                            @if($task->description)
                                <div class="task-description">{{ $task->description }}</div>
                            @endif
                            
                            <div class="task-meta">
                                <span class="task-category">{{ $task->category->name }}</span>
                                <span class="task-due-date">📅 {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</span>
                            </div>
                            
                            <div class="task-actions">
                                <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">↩️ Mark Pending</button>
                                </form>
                                
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">🗑️ Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <p>No completed tasks yet. Complete a task to see it here!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
</body>
</html>
