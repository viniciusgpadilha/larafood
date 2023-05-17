@extends('adminlte::page')

@section('title', "Detalhes do {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item active"><a class="active" href="{{ route('details.plan.index', $plan->url) }}">Detalhes do {{ $plan->name }}</a></li>
    </ol>
    <h1>Detalhes do {{ $plan->name }} <a href="{{ route('details.plan.create', $plan->url) }}" class="ml-3 btn btn-dark"><i class="fas fa-sm fa-plus"></i>  Adicionar Detalhes</a></h1>
@stop
{{-- @dd($details) --}}

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td>{{ $detail->name }}</td>
                            <td>
                                <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-warning">Ver</a>
                                <a href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}" class="btn btn-secondary">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{-- @if (isset($filters))
                {!! $details->appends($filters)->links() !!}
            @else
                {!! $details->links() !!}
            @endif --}}
        </div>
    </div>
@stop
