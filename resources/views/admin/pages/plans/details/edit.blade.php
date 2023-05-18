@extends('adminlte::page')

@section('title', "Editar {$details->name} do {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes do {{ $plan->name }}</a></li>
        <li class="breadcrumb-item active"><a class="active" href="{{ route('details.plan.edit', [$plan->url, $details->id]) }}">Editar</a></li>
    </ol>
    <h1>Editar {{ $details->name }} do {{ $plan->name }}</h1>
@stop
{{-- @dd($details) --}}

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('details.plan.update', [$plan->url, $details->id]) }}" method="post">
                @method('PUT')
                @include('admin.pages.plans.details._partials.form')
            </form>
        </div>
    </div>
@stop