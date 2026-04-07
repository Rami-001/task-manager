@extends('layouts.app')

@section('content')
    <h2>Edit Task</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label>Title:</label>
        <input type="text" name="title" value="{{ $task->title }}" required><br><br>

        <label>Description:</label>
        <textarea name="description">{{ $task->description }}</textarea><br><br>

        <label>Due Date:</label>
        <input type="date" name="due_date" value="{{ $task->due_date }}"><br><br>

        <label>Status:</label>
        <select name="status">
            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in progress" {{ $task->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
        </select><br><br>

        <label>Priority:</label>
        <select name="priority">
            <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
            <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
            <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
        </select><br><br>

        <label>Category:</label>
        <select name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $task->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">Update Task</button>
    </form>
@endsection