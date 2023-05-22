@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a class="active" href="{{ route('permissions.index') }}">Permissões</a></li>
    </ol>
    <h1>Permissões <a href="{{ route('permissions.create') }}" class="ml-3 btn btn-dark"><i class="fas fa-sm fa-plus"></i>  Adicionar Permissão</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('permissions.search') }}" method="post" class="form form-inline">
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
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>
                                {{-- <a href="{{ route('details.plan.index', $plan->url) }}" class="btn btn-primary">Detalhes</a> --}}
                                <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-warning">Ver</a>
                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-secondary">Editar</a>
                                <a href="{{ route('permissions.profiles', $permission->id) }}" class="btn btn-danger">Perfís</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
            @endif

        </div>
    </div>
@stop
