@extends('adminlte::page')

@section('title', "Descrição do {$plan->name}")

@section('content_header')
    <h1>Descrição do <b>{{ $plan->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <ul>
                <li> <strong>Nome: </strong> {{ $plan->name }} </li>
                <li><strong>URL: </strong> {{ $plan->url }}</li>
                <li><strong>Preço: </strong> R$ {{ number_format($plan->price, 2, ',', '.') }}</li>
                <li><strong>Descrição: </strong> {{ $plan->description }}</li>
            </ul>
            <form action="{{ route('plans.destroy', $plan->url) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar {{ $plan->name }}</button>
            </form>
        </div>
    </div>
@stop
