@extends('layouts.base')
<!--Gustavo Adolfo Castillo Paez
ID:858640
TCDS
Frameworks NRC: 66988
4to Semestre
Mario Porras-->
@section('content')


<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white">CRUD de Tareas</h2>
        </div>
        <div>
            <a href="{{route('tasks.create')}}" class="btn btn-primary">Crear tarea</a>
        </div>
    </div>

    @if (Session :: get('success'))
    <div class="alert alert-success mt-2">
        <strong>{{Session :: get('success')}}<br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="col-12 mt-4">
        <table class="table table-bordered text-white">
            <tr class="text-secondary">
                <th>Tarea</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
            @foreach ($tasks as $task)
            <tr>
                <td class="fw-bold">{{$task->title}}</td>
                <td>{{$task->description}}</td>
                <td>{{$task->due_date}}</td>
                <td>
                    <span class="badge bg-warning fs-6">{{$task->status}}</span>
                </td>
                <td>
                    <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn btn-warning">Editar</a>

                    <form action="{{route('tasks.destroy', $task)}}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
            
        </table>
        <div class="d-flex justify-content-center">
            {{ $tasks->links()}}
    </div>
</div>
@endsection