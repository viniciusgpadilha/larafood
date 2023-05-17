@extends('adminlte::page')

@section('title', "Detalhes do {$details->name} do {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes do {{ $plan->name }}</a></li>
        <li class="breadcrumb-item active"><a class="active" href="{{ route('details.plan.edit', [$plan->url, $details->id]) }}">Detalhes</a></li>
    </ol>
    <h1>Editar {{ $details->name }} do {{ $plan->name }}</h1>
@stop
{{-- @dd($details) --}}

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{$details->name}}
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('details.plan.destroy', [$plan->url, $details->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar o {{ $details->name }} do {{ $plan->name }}</button>
            </form>
        </div>
    </div>
@stop
