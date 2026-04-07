@extends('layouts.app')

@section('content')
    <h2>My Tasks</h2>
    <a href="{{ route('tasks.create') }}"><button>Create New Task</button></a>

    <table border="1" cellpadding="10" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>Title</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Category</th>
                <th>Creator</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ ucfirst($task->priority) }}</td>
                    
                    <td>{{ $task->category->name ?? 'None' }}</td> 
                    
                    <td>{{ $task->user->name }}</td>
                    
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="edit-btn">Edit</a>
                        
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection