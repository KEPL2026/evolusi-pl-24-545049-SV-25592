<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Task List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h1 class="mb-4">📋 Task List</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">+ Tambah Task</a>

    <ul class="list-group">
        @forelse ($tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    {{ $task->title }}
                    @if ($task->is_done)
                        <span class="badge bg-success ms-2">Selesai</span>
                    @else
                        <span class="badge bg-warning text-dark ms-2">Pending</span>
                    @endif
                </span>
                <span>
                    <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="d-inline">
                        @csrf @method('PATCH')
                        <button class="btn btn-sm btn-outline-success">
                            {{ $task->is_done ? 'Batal' : 'Selesai' }}
                        </button>
                    </form>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </span>
            </li>
        @empty
            <li class="list-group-item">Belum ada task.</li>
        @endforelse
    </ul>
</div>
</body>
</html>