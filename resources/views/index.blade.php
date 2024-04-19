@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white">Tareas</h2>
        </div>
        <div>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Crear tarea</a>
        </div>
    </div>

    @if (Session::get('success'))
    <div class="alert alert-success mt-2">
        <strong>{{ Session::get('success') }}</strong>
    </div>
    @endif

    <div class="col-12 mt-4">
        <form action="{{ route('tasks.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Estado:</label>
                        <select name="status" class="form-control">
                            <option value="">-- Todos --</option>
                            <option value="Pendiente" {{ request('status') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="En progreso" {{ request('status') == 'En progreso' ? 'selected' : '' }}>En progreso</option>
                            <option value="Completada" {{ request('status') == 'Completada' ? 'selected' : '' }}>Completada</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">Título:</label>
                        <input type="text" name="title" class="form-control" value="{{ request('title') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="due_date">Fecha:</label>
                        <input type="date" name="due_date" class="form-control" value="{{ request('due_date') }}">
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered text-white mt-4">
            <tr class="text-secondary">
                <th>Tarea</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>

            @foreach ($tasks as $task)
            <tr>
                <td class="fw-bold">{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->due_date }}</td>
                <td>
                    <span class="badge {{ $task->status === 'Pendiente' ? 'bg-danger text-white' : ($task->status === 'En progreso' ? 'bg-warning text-dark' : 'bg-success text-white') }} fs-6">{{ $task->status }}</span>
                </td>
                <td>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="post" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta tarea?');">
                        @csrf
                        @method('Delete')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
            
        </table>
        {{ $tasks->links() }}
    </div>
</div>

<script>
import Notification from './Notification.vue';

export default {
  components: {
    Notification
  },
  methods: {
    mostrarNotificacion() {
      this.$refs.notification.showNotification('Mensaje de notificación', 'success');
    },
    mostrarError() {
      this.$refs.notification.showNotification('Error: algo salió mal', 'error');
    }
  }
};
</script>
@endsection
