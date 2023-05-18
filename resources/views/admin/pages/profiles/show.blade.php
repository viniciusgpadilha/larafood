@extends('adminlte::page')

@section('title', "Descrição do {$profile->name}")

@section('content_header')
    <h1>Descrição do <b>{{ $profile->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <ul>
                <li> <strong>Nome: </strong> {{ $profile->name }} </li>
                <li><strong>Descrição: </strong> {{ $profile->description }}</li>
            </ul>
            <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar {{ $profile->name }}</button>
            </form>
        </div>
    </div>
@stop
