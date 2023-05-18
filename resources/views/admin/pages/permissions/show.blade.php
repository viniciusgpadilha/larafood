@extends('adminlte::page')

@section('title', "Descrição do {$permission->name}")

@section('content_header')
    <h1>Descrição do <b>{{ $permission->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <ul>
                <li> <strong>Nome: </strong> {{ $permission->name }} </li>
                <li><strong>Descrição: </strong> {{ $permission->description }}</li>
            </ul>
            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar {{ $permission->name }}</button>
            </form>
        </div>
    </div>
@stop
