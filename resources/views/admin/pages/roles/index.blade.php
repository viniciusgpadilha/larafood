@extends('adminlte::page')

@section('title', 'Cargos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a class="active" href="{{ route('roles.index') }}">Cargos</a></li>
    </ol>
    <h1>Cargos <a href="{{ route('roles.create') }}" class="ml-3 btn btn-dark"><i class="fas fa-sm fa-plus"></i>  Adicionar Cargo</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('roles.search') }}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark"><i class="fas fa-filter"></i> Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-warning">Ver</a>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">Editar</a>
                                <a href="{{ route('roles.permissions', $role->id) }}" class="btn btn-success">Permissões</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $roles->appends($filters)->links() !!}
            @else
                {!! $roles->links() !!}
            @endif

        </div>
    </div>
@stop
